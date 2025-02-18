-- Initial Data Population for Philippine Client Base

-- Client Types
INSERT INTO client_types (name, description, priority_level) VALUES
('Major Telco', 'Major telecommunications provider', 1),
('Regional Telco', 'Regional telecommunications operator', 2),
('ISP Provider', 'Internet Service Provider', 2),
('Enterprise', 'Large enterprise client', 3),
('Government', 'Government agency or institution', 2),
('Broadcasting', 'Broadcasting and media company', 3);

-- Service Types
INSERT INTO service_types (name, description, sla_hours, severity_level, maintenance_frequency) VALUES
('Tower Co-Location', 'Full tower space rental with primary equipment hosting', 4, 'Critical', 30),
('Equipment Hosting', 'Equipment hosting with power and maintenance', 8, 'High', 45),
('Backup Power Service', 'Backup power system service', 2, 'Critical', 30),
('Technical Support', '24/7 Technical support service', 4, 'High', 0),
('Preventive Maintenance', 'Scheduled equipment maintenance', 24, 'Medium', 90),
('Network Monitoring', 'Real-time network and equipment monitoring', 12, 'High', 30);

-- Major Telco Clients
INSERT INTO clients (client_code, company_name, type_id, status, website) VALUES
('PLDT001', 'PLDT Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'Major Telco'), 
    'Active', 'www.pldt.com'),
('SMART001', 'Smart Communications Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'Major Telco'), 
    'Active', 'www.smart.com.ph'),
('GLOBE001', 'Globe Telecom Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'Major Telco'), 
    'Active', 'www.globe.com.ph'),
('DITO001', 'DITO Telecommunity Corp.', 
    (SELECT type_id FROM client_types WHERE name = 'Major Telco'), 
    'Active', 'www.dito.ph');

-- ISP Clients
INSERT INTO clients (client_code, company_name, type_id, status, website) VALUES
('CNVG001', 'Converge ICT Solutions', 
    (SELECT type_id FROM client_types WHERE name = 'ISP Provider'), 
    'Active', 'www.convergeict.com'),
('RISE001', 'Rise Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'ISP Provider'), 
    'Active', 'www.rise.ph'),
('EAST001', 'Eastern Communications', 
    (SELECT type_id FROM client_types WHERE name = 'ISP Provider'), 
    'Active', 'www.eastern.com.ph');

-- Broadcasting Clients
INSERT INTO clients (client_code, company_name, type_id, status, website) VALUES
('ABS001', 'ABS-CBN Corporation', 
    (SELECT type_id FROM client_types WHERE name = 'Broadcasting'), 
    'Active', 'www.abs-cbn.com'),
('GMA001', 'GMA Network Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'Broadcasting'), 
    'Active', 'www.gmanetwork.com'),
('TV5001', 'TV5 Network Inc.', 
    (SELECT type_id FROM client_types WHERE name = 'Broadcasting'), 
    'Active', 'www.tv5.com.ph');

-- Enterprise Clients
INSERT INTO clients (client_code, company_name, type_id, status, website) VALUES
('SMC001', 'San Miguel Corporation', 
    (SELECT type_id FROM client_types WHERE name = 'Enterprise'), 
    'Active', 'www.sanmiguel.com.ph'),
('ACEN001', 'ACEN Corporation', 
    (SELECT type_id FROM client_types WHERE name = 'Enterprise'), 
    'Active', 'www.acenergy.com.ph'),
('MPIC001', 'Metro Pacific Investments', 
    (SELECT type_id FROM client_types WHERE name = 'Enterprise'), 
    'Active', 'www.mpic.com.ph');

-- Sample Client Contacts for Major Telcos
INSERT INTO client_contacts (client_id, name, position, email, phone, mobile, is_primary, is_technical) VALUES
-- PLDT Contacts
((SELECT client_id FROM clients WHERE client_code = 'PLDT001'),
 'Juan dela Cruz', 'Network Operations Head', 'juan.delacruz@pldt.com.ph', 
 '(02) 8888-1234', '+63917-123-4567', true, true),
((SELECT client_id FROM clients WHERE client_code = 'PLDT001'),
 'Maria Santos', 'Technical Coordinator', 'maria.santos@pldt.com.ph', 
 '(02) 8888-1235', '+63917-123-4568', false, true),

-- Globe Contacts
((SELECT client_id FROM clients WHERE client_code = 'GLOBE001'),
 'Ramon Garcia', 'Infrastructure Manager', 'ramon.garcia@globe.com.ph', 
 '(02) 7777-1234', '+63918-123-4567', true, true),
((SELECT client_id FROM clients WHERE client_code = 'GLOBE001'),
 'Ana Reyes', 'Technical Supervisor', 'ana.reyes@globe.com.ph', 
 '(02) 7777-1235', '+63918-123-4568', false, true),

-- DITO Contacts
((SELECT client_id FROM clients WHERE client_code = 'DITO001'),
 'Carlos Tan', 'Operations Director', 'carlos.tan@dito.ph', 
 '(02) 6666-1234', '+63919-123-4567', true, true),
((SELECT client_id FROM clients WHERE client_code = 'DITO001'),
 'Patricia Lim', 'Network Engineer', 'patricia.lim@dito.ph', 
 '(02) 6666-1235', '+63919-123-4568', false, true);

-- Sample Contracts for Major Telcos
INSERT INTO client_contracts (
    client_id, contract_code, start_date, end_date, 
    status, contract_type, service_level, auto_renewal, renewal_notice_days
) VALUES
-- PLDT Contracts
((SELECT client_id FROM clients WHERE client_code = 'PLDT001'),
 'PLDTC-2024-001', '2024-01-01', '2029-12-31', 
 'Active', 'Master Service Agreement', 'Platinum', true, 90),

-- Globe Contracts
((SELECT client_id FROM clients WHERE client_code = 'GLOBE001'),
 'GLOBEC-2024-001', '2024-01-01', '2029-12-31', 
 'Active', 'Master Service Agreement', 'Platinum', true, 90),

-- DITO Contracts
((SELECT client_id FROM clients WHERE client_code = 'DITO001'),
 'DITOC-2024-001', '2024-01-01', '2029-12-31', 
 'Active', 'Master Service Agreement', 'Platinum', true, 90);

-- Contract Services
INSERT INTO contract_services (
    contract_id, service_id, quantity, start_date, end_date, 
    status, sla_terms
) VALUES
-- PLDT Services
((SELECT contract_id FROM client_contracts WHERE contract_code = 'PLDTC-2024-001'),
 (SELECT service_id FROM service_types WHERE name = 'Tower Co-Location'),
 10, '2024-01-01', '2029-12-31', 'Active',
 'Response Time: 4 hours; Resolution Time: 8 hours; Availability: 99.99%'),

-- Globe Services
((SELECT contract_id FROM client_contracts WHERE contract_code = 'GLOBEC-2024-001'),
 (SELECT service_id FROM service_types WHERE name = 'Tower Co-Location'),
 8, '2024-01-01', '2029-12-31', 'Active',
 'Response Time: 4 hours; Resolution Time: 8 hours; Availability: 99.99%'),

-- DITO Services
((SELECT contract_id FROM client_contracts WHERE contract_code = 'DITOC-2024-001'),
 (SELECT service_id FROM service_types WHERE name = 'Tower Co-Location'),
 12, '2024-01-01', '2029-12-31', 'Active',
 'Response Time: 4 hours; Resolution Time: 8 hours; Availability: 99.99%');

-- Sample Contract Terms
INSERT INTO contract_terms (
    contract_id, term_type, description, value, priority, is_mandatory
) VALUES
-- PLDT Terms
((SELECT contract_id FROM client_contracts WHERE contract_code = 'PLDTC-2024-001'),
 'Service Availability', 'Minimum service availability requirement',
 '99.99%', 1, true),
((SELECT contract_id FROM client_contracts WHERE contract_code = 'PLDTC-2024-001'),
 'Response Time', 'Maximum response time for critical issues',
 '4 hours', 1, true),

-- Globe Terms
((SELECT contract_id FROM client_contracts WHERE contract_code = 'GLOBEC-2024-001'),
 'Service Availability', 'Minimum service availability requirement',
 '99.99%', 1, true),
((SELECT contract_id FROM client_contracts WHERE contract_code = 'GLOBEC-2024-001'),
 'Response Time', 'Maximum response time for critical issues',
 '4 hours', 1, true),

-- DITO Terms
((SELECT contract_id FROM client_contracts WHERE contract_code = 'DITOC-2024-001'),
 'Service Availability', 'Minimum service availability requirement',
 '99.99%', 1, true),
((SELECT contract_id FROM client_contracts WHERE contract_code = 'DITOC-2024-001'),
 'Response Time', 'Maximum response time for critical issues',
 '4 hours', 1, true);