-- Main database for PhilTower PRIME System - (_uac)

-- Insert Core Systems
INSERT INTO systems (system_name, system_code, description) VALUES
('PRIME-UAC', 'UAC', 'User Access Control - Authentication & Security System'),
('PRIME-CCS', 'CCS', 'Command Center System - Tower Operations Hub'),
('PRIME-AMS', 'AMS', 'Asset Management System - Tower & Equipment Management'),
('PRIME-SCS', 'SCS', 'Security Control System - Access & Surveillance Platform'),
('PRIME-CMS', 'CMS', 'Client Management System - Client & Contract Management'),
('PRIME-EMS', 'EMS', 'Employee Management System - Personnel & Training Control'),
('PRIME-RAS', 'RAS', 'Real-Time Analytics System - Business Intelligence Hub');

-- Insert Departments
INSERT INTO departments (department_name, description) VALUES
('Command Center', 'Central tower operations control'),
('Tower Operations', 'Tower maintenance and management'),
('Security Operations', 'Security and surveillance management'),
('Client Services', 'Client relations and contract management'),
('Technical Support', 'Equipment and technical maintenance'),
('System Administration', 'System and security administration'),
('Human Resources', 'Personnel and training management');

-- UAC System User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(-1, 'System Administrator', 'Complete system control and configuration access', 
    (SELECT system_id FROM systems WHERE system_code = 'UAC')),
(1001, 'Security Manager', 'Security policy and access management', 
    (SELECT system_id FROM systems WHERE system_code = 'UAC')),
(1002, 'User Manager', 'Basic user management and support', 
    (SELECT system_id FROM systems WHERE system_code = 'UAC'));

-- Command Center System (CCS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(2000, 'Command Center Admin', 'Full command center system control', 
    (SELECT system_id FROM systems WHERE system_code = 'CCS')),
(2001, 'Operations Manager', 'Tower operations management', 
    (SELECT system_id FROM systems WHERE system_code = 'CCS')),
(2002, 'Control Room Operator', 'Tower monitoring and alert management', 
    (SELECT system_id FROM systems WHERE system_code = 'CCS'));

-- Asset Management System (AMS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(3000, 'Asset System Admin', 'Full asset management system control', 
    (SELECT system_id FROM systems WHERE system_code = 'AMS')),
(3001, 'Maintenance Manager', 'Equipment maintenance oversight', 
    (SELECT system_id FROM systems WHERE system_code = 'AMS')),
(3002, 'Technical Officer', 'Equipment maintenance and monitoring', 
    (SELECT system_id FROM systems WHERE system_code = 'AMS'));

-- Security Control System (SCS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(4000, 'Security System Admin', 'Full security system administration', 
    (SELECT system_id FROM systems WHERE system_code = 'SCS')),
(4001, 'Security Supervisor', 'Security team management', 
    (SELECT system_id FROM systems WHERE system_code = 'SCS')),
(4002, 'Security Officer', 'Access control and surveillance', 
    (SELECT system_id FROM systems WHERE system_code = 'SCS'));

-- Client Management System (CMS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(5000, 'Client System Admin', 'Full client system administration', 
    (SELECT system_id FROM systems WHERE system_code = 'CMS')),
(5001, 'Account Manager', 'Client relationship management', 
    (SELECT system_id FROM systems WHERE system_code = 'CMS')),
(5002, 'Service Coordinator', 'Client service management', 
    (SELECT system_id FROM systems WHERE system_code = 'CMS'));

-- Employee Management System (EMS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(6000, 'HR System Admin', 'Full HR system administration', 
    (SELECT system_id FROM systems WHERE system_code = 'EMS')),
(6001, 'HR Manager', 'Personnel management and training', 
    (SELECT system_id FROM systems WHERE system_code = 'EMS')),
(6002, 'HR Officer', 'Employee records and scheduling', 
    (SELECT system_id FROM systems WHERE system_code = 'EMS'));

-- Analytics System (RAS) User Levels
INSERT INTO user_levels (user_level_id, name, description, system_id) VALUES
(7000, 'Analytics Admin', 'Full analytics system administration', 
    (SELECT system_id FROM systems WHERE system_code = 'RAS')),
(7001, 'Business Analyst', 'Data analysis and reporting', 
    (SELECT system_id FROM systems WHERE system_code = 'RAS')),
(7002, 'Report Viewer', 'Report access and basic analysis', 
    (SELECT system_id FROM systems WHERE system_code = 'RAS'));

-- Insert System Administrator
INSERT INTO users (user_id, username, email, password_hash, first_name, last_name, department_id) VALUES
(-1, 'prime.admin', 'admin@philtower.com', '$2y$10$encrypted_hash_here', 'PRIME', 'Administrator', 
    (SELECT department_id FROM departments WHERE department_name = 'System Administration'));

-- Insert Sample Users for Each Department
INSERT INTO users (username, email, password_hash, first_name, last_name, department_id) VALUES
-- Command Center Team
('cmd.manager', 'cmd.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Command', 'Manager', 
    (SELECT department_id FROM departments WHERE department_name = 'Command Center')),
('cmd.operator1', 'cmd.operator1@philtower.com', '$2y$10$encrypted_hash_here', 'Command', 'Operator 1', 
    (SELECT department_id FROM departments WHERE department_name = 'Command Center')),

-- Tower Operations Team
('tower.manager', 'tower.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Tower', 'Manager', 
    (SELECT department_id FROM departments WHERE department_name = 'Tower Operations')),
('tech.officer1', 'tech.officer1@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', 'Officer 1', 
    (SELECT department_id FROM departments WHERE department_name = 'Tower Operations')),

-- Security Team
('security.supervisor', 'security.supervisor@philtower.com', '$2y$10$encrypted_hash_here', 'Security', 'Supervisor', 
    (SELECT department_id FROM departments WHERE department_name = 'Security Operations')),
('security.officer1', 'security.officer1@philtower.com', '$2y$10$encrypted_hash_here', 'Security', 'Officer 1', 
    (SELECT department_id FROM departments WHERE department_name = 'Security Operations')),

-- Client Services Team
('client.manager', 'client.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Client', 'Manager', 
    (SELECT department_id FROM departments WHERE department_name = 'Client Services')),
('service.coordinator', 'service.coordinator@philtower.com', '$2y$10$encrypted_hash_here', 'Service', 'Coordinator', 
    (SELECT department_id FROM departments WHERE department_name = 'Client Services')),

-- Technical Support Team
('tech.supervisor', 'tech.supervisor@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', 'Supervisor', 
    (SELECT department_id FROM departments WHERE department_name = 'Technical Support')),
('tech.support1', 'tech.support1@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', 'Support 1', 
    (SELECT department_id FROM departments WHERE department_name = 'Technical Support'));

-- User Level Assignments
INSERT INTO user_level_assignments (user_id, system_id, user_level_id, assigned_by, created_at) VALUES
-- Command Center Team Assignments
((SELECT user_id FROM users WHERE username = 'cmd.manager'), 
 (SELECT system_id FROM systems WHERE system_code = 'CCS'),
 2001, -- Operations Manager
 -1,
 CURRENT_TIMESTAMP),

((SELECT user_id FROM users WHERE username = 'cmd.operator1'), 
 (SELECT system_id FROM systems WHERE system_code = 'CCS'),
 2002, -- Control Room Operator
 -1,
 CURRENT_TIMESTAMP),

-- Tower Operations Team Assignments
((SELECT user_id FROM users WHERE username = 'tower.manager'), 
 (SELECT system_id FROM systems WHERE system_code = 'AMS'),
 3001, -- Maintenance Manager
 -1,
 CURRENT_TIMESTAMP),

-- Security Team Assignments
((SELECT user_id FROM users WHERE username = 'security.supervisor'), 
 (SELECT system_id FROM systems WHERE system_code = 'SCS'),
 4001, -- Security Supervisor
 -1,
 CURRENT_TIMESTAMP),

-- Client Services Team Assignments
((SELECT user_id FROM users WHERE username = 'client.manager'), 
 (SELECT system_id FROM systems WHERE system_code = 'CMS'),
 5001, -- Account Manager
 -1,
 CURRENT_TIMESTAMP);