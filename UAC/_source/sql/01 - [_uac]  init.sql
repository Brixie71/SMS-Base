-- Main database for User & System Management - (philtower_uac)

-- Drop existing tables if they exist

DROP TABLE IF EXISTS user_level_permissions CASCADE;
DROP TABLE IF EXISTS user_level_assignments CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS departments CASCADE;
DROP TABLE IF EXISTS user_levels CASCADE;
DROP TABLE IF EXISTS systems CASCADE;
DROP TABLE IF EXISTS audit_logs CASCADE;

-- Create systems table
CREATE TABLE systems (
    system_id SERIAL PRIMARY KEY,
    system_name VARCHAR(50) NOT NULL,
    system_code VARCHAR(10) UNIQUE NOT NULL,
    description TEXT,
    level_permissions JSONB
);

-- User Levels Table
CREATE TABLE user_levels (
    user_level_id INT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    system_id INTEGER REFERENCES systems(system_id),
    UNIQUE(user_level_id)
);

-- Users Department Table
CREATE TABLE departments (
    department_id SERIAL PRIMARY KEY,
    department_name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT
);

-- Users Table
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    user_level_id VARCHAR(255),
    reports_to_user_id INT REFERENCES users(user_id),
    photo VARCHAR(255),
    mobile_number VARCHAR(20),
    department_id INT REFERENCES departments(department_id),
    profile TEXT
);

-- Create user_level_assignments table
CREATE TABLE user_level_assignments (
    assignment_id SERIAL PRIMARY KEY,
    system_id INTEGER REFERENCES systems(system_id),
    user_id INTEGER REFERENCES users(user_id),
    user_level_id INTEGER REFERENCES user_levels(user_level_id),
    assigned_by INTEGER REFERENCES users(user_id),
    created_at TIMESTAMP,
    UNIQUE(user_id, user_level_id)
);

-- User Level Permissions Table
CREATE TABLE user_level_permissions (
    user_level_id INT NOT NULL,
    table_name VARCHAR(80) NOT NULL,
    permission INT NOT NULL,
    PRIMARY KEY (user_level_id, table_name),
    FOREIGN KEY (user_level_id) REFERENCES user_levels(user_level_id) ON DELETE CASCADE
);



-- Drop existing triggers if they exist
DROP TRIGGER IF EXISTS user_level_assignment_insert ON user_level_assignments;
DROP TRIGGER IF EXISTS user_level_assignment_update ON user_level_assignments;
DROP TRIGGER IF EXISTS user_level_assignment_delete ON user_level_assignments;

-- Drop the function if it exists


-- Modify the update_user_levels() function to handle VARCHAR user_level_id
CREATE OR REPLACE FUNCTION update_user_levels()
RETURNS TRIGGER AS $$
DECLARE
    latest_level_id VARCHAR;
BEGIN
    -- Get the latest user level assignment for the affected user
    SELECT CAST(user_level_id AS VARCHAR) INTO latest_level_id
    FROM user_level_assignments
    WHERE user_id = COALESCE(NEW.user_id, OLD.user_id)
    ORDER BY assignment_id DESC
    LIMIT 1;

    -- Update the users table with the latest user_level_id, handling NULL cases
    UPDATE users
    SET user_level_id = 
        CASE 
            WHEN latest_level_id IS NOT NULL THEN latest_level_id
            ELSE user_level_id -- Keep the existing value if no new assignment
        END
    WHERE user_id = COALESCE(NEW.user_id, OLD.user_id);

    RETURN NULL; -- for AFTER triggers
END;
$$ LANGUAGE plpgsql;

-- Recreate the triggers (no changes needed here, but included for completeness)
DROP TRIGGER IF EXISTS user_level_assignment_insert ON user_level_assignments;
DROP TRIGGER IF EXISTS user_level_assignment_update ON user_level_assignments;
DROP TRIGGER IF EXISTS user_level_assignment_delete ON user_level_assignments;

CREATE TRIGGER user_level_assignment_insert
AFTER INSERT ON user_level_assignments
FOR EACH ROW
EXECUTE FUNCTION update_user_levels();

CREATE TRIGGER user_level_assignment_update
AFTER UPDATE ON user_level_assignments
FOR EACH ROW
EXECUTE FUNCTION update_user_levels();

CREATE TRIGGER user_level_assignment_delete
AFTER DELETE ON user_level_assignments
FOR EACH ROW
EXECUTE FUNCTION update_user_levels();

-- Audit Logs
CREATE TABLE audit_logs (
    id SERIAL PRIMARY KEY,
    date_time TIMESTAMP NOT NULL,
    script VARCHAR(255),
    "user" VARCHAR(255),
    action VARCHAR(255),
    "table" VARCHAR(255),
    field VARCHAR(255),
    key_value TEXT,
    old_value TEXT,
    new_value TEXT
);

-- Create indexes
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_reports_to ON users(reports_to_user_id);
CREATE INDEX idx_systems_code ON systems(system_code);
CREATE INDEX idx_user_levels_system ON user_levels(system_id);
CREATE INDEX idx_user_level_assignments_user ON user_level_assignments(user_id);
CREATE INDEX idx_user_level_assignments_level ON user_level_assignments(user_level_id);
CREATE INDEX idx_user_level_permissions_level ON user_level_permissions(user_level_id);
CREATE INDEX idx_user_level_permissions_table ON user_level_permissions(table_name);

-- Create the view to aggregate and group the audit logs
CREATE OR REPLACE VIEW aggregated_audit_logs AS
SELECT 
    TO_CHAR(DATE(date_time), 'YYYY-MM-DD') AS action_date,
    script,
    "user",
    action,
    "table",
    CASE 
        WHEN action = 'A' THEN 'Add'
        WHEN action = 'D' THEN 'Delete'
        WHEN action = 'U' THEN 'Update'
        WHEN action = 'login' THEN 'Login'
        WHEN action = 'logout' THEN 'Logout'
        ELSE action
    END AS action_type,
    CASE
        WHEN action IN ('A', 'D', 'U') THEN 
            string_agg(
                field || ': ' || 
                CASE 
                    WHEN field IN ('date_created', 'last_login') THEN 
                        COALESCE(TO_CHAR(NULLIF(old_value, '')::timestamp, 'YYYY-MM-DD HH24:MI:SS'), '')
                    ELSE 
                        COALESCE(old_value, '')
                END ||
                CASE WHEN action = 'U' THEN ' -> ' ELSE '' END || 
                CASE 
                    WHEN field IN ('date_created', 'last_login') THEN 
                        COALESCE(TO_CHAR(NULLIF(new_value, '')::timestamp, 'YYYY-MM-DD HH24:MI:SS'), '')
                    ELSE 
                        COALESCE(new_value, '')
                END,
                E'\n' ORDER BY id
            )
        WHEN action IN ('login', 'logout') THEN
            MAX(key_value)  -- This will contain the IP address for login/logout actions
        ELSE
            string_agg(
                field || ': ' || 
                COALESCE(old_value, '') || ' -> ' || 
                COALESCE(new_value, ''),
                E'\n' ORDER BY id
            )
    END AS details,
    COUNT(*) AS action_count,
    MIN(id) AS aggregated_id
FROM 
    audit_logs
GROUP BY 
    DATE(date_time), script, "user", action, "table"
ORDER BY 
    MIN(id) DESC;