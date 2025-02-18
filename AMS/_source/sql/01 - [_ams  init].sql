-- Main database for Asset Management System - (philtower_ams)

-- Drop existing tables if they exist
DROP TABLE IF EXISTS maintenance_parts CASCADE;
DROP TABLE IF EXISTS maintenance_logs CASCADE;
DROP TABLE IF EXISTS maintenance_findings CASCADE;
DROP TABLE IF EXISTS maintenance_actions CASCADE;
DROP TABLE IF EXISTS maintenance_schedules CASCADE;
DROP TABLE IF EXISTS maintenance_teams CASCADE;
DROP TABLE IF EXISTS team_members CASCADE;
DROP TABLE IF EXISTS equipment_specifications CASCADE;
DROP TABLE IF EXISTS tower_equipment CASCADE;
DROP TABLE IF EXISTS equipment_models CASCADE;
DROP TABLE IF EXISTS equipment_types CASCADE;
DROP TABLE IF EXISTS manufacturers CASCADE;
DROP TABLE IF EXISTS tower_specifications CASCADE;
DROP TABLE IF EXISTS towers CASCADE;
DROP TABLE IF EXISTS tower_types CASCADE;
DROP TABLE IF EXISTS tower_statuses CASCADE;
DROP TABLE IF EXISTS specification_types CASCADE;
DROP TABLE IF EXISTS maintenance_types CASCADE;
DROP TABLE IF EXISTS status_types CASCADE;
DROP TABLE IF EXISTS unit_categories CASCADE;
DROP TABLE IF EXISTS measurement_units CASCADE;

-- Create base configuration tables
CREATE TABLE unit_categories (
    category_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE measurement_units (
    unit_id SERIAL PRIMARY KEY,
    category_id INT REFERENCES unit_categories(category_id),
    name VARCHAR(50) NOT NULL,
    symbol VARCHAR(10) NOT NULL,
    conversion_factor DECIMAL(15,6),
    base_unit_id INT REFERENCES measurement_units(unit_id),
    description TEXT
);

CREATE TABLE specification_types (
    spec_type_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    data_type VARCHAR(50), -- varchar, numeric, boolean, etc.
    unit_category_id INT REFERENCES unit_categories(category_id),
    validation_rules JSONB,
    is_required BOOLEAN DEFAULT false
);

CREATE TABLE status_types (
    status_id SERIAL PRIMARY KEY,
    category VARCHAR(50) NOT NULL, -- tower, equipment, maintenance, etc.
    name VARCHAR(50) NOT NULL,
    description TEXT,
    is_operational BOOLEAN DEFAULT true,
    color_code VARCHAR(7), -- Hex color code
    icon_class VARCHAR(50),
    sequence_no INT,
    UNIQUE (category, name)
);

-- Tower Management Tables
CREATE TABLE tower_types (
    type_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    height_limit DECIMAL(10,2),
    equipment_limit INT,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP
);

CREATE TABLE towers (
    tower_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) UNIQUE NOT NULL,
    type_id INT REFERENCES tower_types(type_id),
    status_id INT REFERENCES status_types(status_id),
    height DECIMAL(10,2),
    latitude DECIMAL(10,6),
    longitude DECIMAL(10,6),
    address TEXT,
    city VARCHAR(100),
    region VARCHAR(100),
    installation_date DATE,
    last_maintenance DATE,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    notes TEXT
);

CREATE TABLE tower_specifications (
    spec_id SERIAL PRIMARY KEY,
    tower_id INT REFERENCES towers(tower_id),
    spec_type_id INT REFERENCES specification_types(spec_type_id),
    value TEXT,
    unit_id INT REFERENCES measurement_units(unit_id),
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    UNIQUE (tower_id, spec_type_id)
);

-- Equipment Management Tables
CREATE TABLE manufacturers (
    manufacturer_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(100),
    contact_number VARCHAR(50),
    email VARCHAR(100),
    address TEXT,
    website VARCHAR(255),
    support_contact TEXT,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP
);

CREATE TABLE equipment_types (
    type_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    description TEXT,
    maintenance_interval INT, -- Days between maintenance
    requires_certification BOOLEAN DEFAULT false,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP
);

CREATE TABLE equipment_models (
    model_id SERIAL PRIMARY KEY,
    manufacturer_id INT REFERENCES manufacturers(manufacturer_id),
    type_id INT REFERENCES equipment_types(type_id),
    model_number VARCHAR(100) NOT NULL,
    name VARCHAR(100),
    description TEXT,
    specifications JSONB,
    support_end_date DATE,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    notes TEXT
);

CREATE TABLE tower_equipment (
    equipment_id SERIAL PRIMARY KEY,
    tower_id INT REFERENCES towers(tower_id),
    model_id INT REFERENCES equipment_models(model_id),
    serial_number VARCHAR(100) UNIQUE,
    installation_date DATE,
    warranty_expiry DATE,
    status_id INT REFERENCES status_types(status_id),
    last_maintenance DATE,
    next_maintenance DATE,
    client_id INT, -- References CMS clients
    installed_by INT, -- References UAC users
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    is_active BOOLEAN DEFAULT true,
    notes TEXT
);

CREATE TABLE equipment_specifications (
    spec_id SERIAL PRIMARY KEY,
    equipment_id INT REFERENCES tower_equipment(equipment_id),
    spec_type_id INT REFERENCES specification_types(spec_type_id),
    value TEXT,
    unit_id INT REFERENCES measurement_units(unit_id),
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    UNIQUE (equipment_id, spec_type_id)
);

-- Maintenance Management Tables
CREATE TABLE maintenance_types (
    type_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    estimated_duration INT, -- Minutes
    required_skills TEXT[],
    checklist_items JSONB,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP
);

CREATE TABLE maintenance_teams (
    team_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    supervisor_id INT, -- References UAC users
    description TEXT,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    is_active BOOLEAN DEFAULT true
);

CREATE TABLE team_members (
    team_id INT REFERENCES maintenance_teams(team_id),
    user_id INT, -- References UAC users
    role VARCHAR(50),
    assigned_date DATE,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (team_id, user_id)
);

CREATE TABLE maintenance_schedules (
    schedule_id SERIAL PRIMARY KEY,
    equipment_id INT REFERENCES tower_equipment(equipment_id),
    maintenance_type_id INT REFERENCES maintenance_types(type_id),
    team_id INT REFERENCES maintenance_teams(team_id),
    scheduled_date DATE,
    status_id INT REFERENCES status_types(status_id),
    priority VARCHAR(20),
    estimated_duration INT, -- Minutes
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    notes TEXT
);

CREATE TABLE maintenance_logs (
    log_id SERIAL PRIMARY KEY,
    schedule_id INT REFERENCES maintenance_schedules(schedule_id),
    start_time TIMESTAMP,
    end_time TIMESTAMP,
    performed_by INT, -- References UAC users
    verified_by INT, -- References UAC users
    status_id INT REFERENCES status_types(status_id),
    next_maintenance_date DATE,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_by INT, -- References UAC users
    updated_at TIMESTAMP,
    notes TEXT
);

CREATE TABLE maintenance_findings (
    finding_id SERIAL PRIMARY KEY,
    log_id INT REFERENCES maintenance_logs(log_id),
    finding_type VARCHAR(50),
    description TEXT,
    severity VARCHAR(20),
    recommendation TEXT,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE maintenance_actions (
    action_id SERIAL PRIMARY KEY,
    log_id INT REFERENCES maintenance_logs(log_id),
    action_type VARCHAR(50),
    description TEXT,
    result TEXT,
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE maintenance_parts (
    part_id SERIAL PRIMARY KEY,
    log_id INT REFERENCES maintenance_logs(log_id),
    part_name VARCHAR(100),
    quantity INT,
    unit_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    supplier VARCHAR(100),
    warranty_period INT, -- Days
    created_by INT, -- References UAC users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT
);

-- Create indexes
CREATE INDEX idx_towers_code ON towers(code);
CREATE INDEX idx_towers_status ON towers(status_id);
CREATE INDEX idx_towers_type ON towers(type_id);
CREATE INDEX idx_equipment_serial ON tower_equipment(serial_number);
CREATE INDEX idx_equipment_tower ON tower_equipment(tower_id);
CREATE INDEX idx_equipment_model ON tower_equipment(model_id);
CREATE INDEX idx_equipment_status ON tower_equipment(status_id);
CREATE INDEX idx_equipment_client ON tower_equipment(client_id);
CREATE INDEX idx_maintenance_equipment ON maintenance_schedules(equipment_id);
CREATE INDEX idx_maintenance_team ON maintenance_schedules(team_id);
CREATE INDEX idx_maintenance_type ON maintenance_schedules(maintenance_type_id);
CREATE INDEX idx_maintenance_status ON maintenance_schedules(status_id);
CREATE INDEX idx_maintenance_date ON maintenance_schedules(scheduled_date);
CREATE INDEX idx_logs_schedule ON maintenance_logs(schedule_id);
CREATE INDEX idx_specifications_tower ON tower_specifications(tower_id);
CREATE INDEX idx_specifications_equipment ON equipment_specifications(equipment_id);