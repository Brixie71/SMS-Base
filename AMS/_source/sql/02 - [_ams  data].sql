-- Initial data population for Asset Management System (_ams)

-- Unit Categories
INSERT INTO unit_categories (name, description) VALUES
('Length', 'Linear measurement units'),
('Weight', 'Mass measurement units'),
('Power', 'Electrical power measurement units'),
('Temperature', 'Temperature measurement units'),
('Frequency', 'Frequency measurement units'),
('Data', 'Digital data measurement units');

-- Measurement Units
INSERT INTO measurement_units (category_id, name, symbol, conversion_factor, base_unit_id) VALUES
-- Length Units
((SELECT category_id FROM unit_categories WHERE name = 'Length'), 'Meter', 'm', 1, NULL),
((SELECT category_id FROM unit_categories WHERE name = 'Length'), 'Centimeter', 'cm', 0.01, NULL),
-- Weight Units
((SELECT category_id FROM unit_categories WHERE name = 'Weight'), 'Kilogram', 'kg', 1, NULL),
((SELECT category_id FROM unit_categories WHERE name = 'Weight'), 'Gram', 'g', 0.001, NULL),
-- Power Units
((SELECT category_id FROM unit_categories WHERE name = 'Power'), 'Watt', 'W', 1, NULL),
((SELECT category_id FROM unit_categories WHERE name = 'Power'), 'Kilowatt', 'kW', 1000, NULL),
-- Temperature Units
((SELECT category_id FROM unit_categories WHERE name = 'Temperature'), 'Celsius', '°C', 1, NULL),
-- Frequency Units
((SELECT category_id FROM unit_categories WHERE name = 'Frequency'), 'Hertz', 'Hz', 1, NULL),
((SELECT category_id FROM unit_categories WHERE name = 'Frequency'), 'Megahertz', 'MHz', 1000000, NULL),
-- Data Units
((SELECT category_id FROM unit_categories WHERE name = 'Data'), 'Megabyte', 'MB', 1, NULL),
((SELECT category_id FROM unit_categories WHERE name = 'Data'), 'Gigabyte', 'GB', 1024, NULL);

-- Status Types
INSERT INTO status_types (category, name, description, is_operational, color_code) VALUES
-- Tower Statuses
('tower', 'Active', 'Fully operational tower', true, '#00FF00'),
('tower', 'Maintenance', 'Under scheduled maintenance', false, '#FFA500'),
('tower', 'Repair', 'Under repair', false, '#FF0000'),
('tower', 'Inactive', 'Temporarily inactive', false, '#808080'),
-- Equipment Statuses
('equipment', 'Operational', 'Fully functional equipment', true, '#00FF00'),
('equipment', 'Maintenance Required', 'Scheduled maintenance needed', true, '#FFA500'),
('equipment', 'Faulty', 'Equipment malfunction', false, '#FF0000'),
('equipment', 'Decommissioned', 'No longer in service', false, '#808080'),
-- Maintenance Statuses
('maintenance', 'Scheduled', 'Maintenance task scheduled', true, '#0000FF'),
('maintenance', 'In Progress', 'Maintenance work ongoing', true, '#FFA500'),
('maintenance', 'Completed', 'Maintenance task finished', true, '#00FF00'),
('maintenance', 'Cancelled', 'Maintenance task cancelled', false, '#FF0000');

-- Tower Types
INSERT INTO tower_types (name, description, height_limit, equipment_limit) VALUES
('Monopole', 'Single pole tower structure', 50.00, 10),
('Lattice', 'Traditional lattice tower structure', 100.00, 20),
('Guyed', 'Guy-wire supported tower', 150.00, 15),
('Rooftop', 'Rooftop mounted tower', 30.00, 8),
('Stealth', 'Concealed/camouflaged tower', 40.00, 6);

-- Specification Types
INSERT INTO specification_types (name, description, data_type, unit_category_id, is_required) VALUES
-- Tower Specifications
('Height', 'Tower height measurement', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Length'), true),
('Base Width', 'Width of tower base', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Length'), true),
('Weight Capacity', 'Maximum equipment weight capacity', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Weight'), true),
('Wind Rating', 'Maximum wind speed rating', 'numeric', null, true),
-- Equipment Specifications
('Power Rating', 'Power consumption rating', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Power'), true),
('Operating Temperature', 'Operating temperature range', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Temperature'), true),
('Frequency Range', 'Operating frequency range', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Frequency'), false),
('Storage Capacity', 'Data storage capacity', 'numeric', 
    (SELECT category_id FROM unit_categories WHERE name = 'Data'), false);

-- Equipment Types
INSERT INTO equipment_types (name, category, description, maintenance_interval, requires_certification) VALUES
('Antenna', 'RF', 'Radio frequency antenna systems', 90, true),
('Radio Unit', 'RF', 'Radio transmission equipment', 60, true),
('Power System', 'Power', 'Main power supply units', 30, true),
('Battery Bank', 'Power', 'Backup power systems', 45, true),
('AC Unit', 'Environmental', 'Air conditioning systems', 30, false),
('Security Camera', 'Security', 'CCTV surveillance cameras', 60, false),
('Lightning Protection', 'Safety', 'Lightning protection systems', 180, true),
('Cable System', 'Infrastructure', 'Cable management systems', 90, false);

-- Manufacturers
INSERT INTO manufacturers (name, contact_person, contact_number, email, website) VALUES
('TowerTech Industries', 'John Smith', '+1-555-0101', 'contact@towertech.com', 'www.towertech.com'),
('PowerSys Solutions', 'Mary Johnson', '+1-555-0102', 'support@powersys.com', 'www.powersys.com'),
('RF Systems Corp', 'David Wilson', '+1-555-0103', 'sales@rfsystems.com', 'www.rfsystems.com'),
('SecureView Systems', 'Robert Brown', '+1-555-0104', 'info@secureview.com', 'www.secureview.com'),
('ClimateControl Tech', 'Sarah Davis', '+1-555-0105', 'support@climatecontrol.com', 'www.climatecontrol.com');

-- Equipment Models
INSERT INTO equipment_models (manufacturer_id, type_id, model_number, name, description) VALUES
((SELECT manufacturer_id FROM manufacturers WHERE name = 'RF Systems Corp'),
 (SELECT type_id FROM equipment_types WHERE name = 'Antenna'),
 'ANT-2024-PRO', 'Professional Series Antenna', 'High-gain professional antenna system'),

((SELECT manufacturer_id FROM manufacturers WHERE name = 'PowerSys Solutions'),
 (SELECT type_id FROM equipment_types WHERE name = 'Power System'),
 'PS-5000-UPS', 'Industrial UPS', 'Uninterruptible power supply system'),

((SELECT manufacturer_id FROM manufacturers WHERE name = 'SecureView Systems'),
 (SELECT type_id FROM equipment_types WHERE name = 'Security Camera'),
 'SV-PRO-360', '360° Security Camera', 'High-resolution security camera system');

-- Maintenance Types
INSERT INTO maintenance_types (name, description, estimated_duration, required_skills, checklist_items) VALUES
('Routine Inspection', 'Regular equipment check and basic maintenance', 60,
 ARRAY['Basic Maintenance', 'Safety Procedures'],
 '{"items": ["Visual inspection", "Clean equipment", "Check connections", "Basic testing"]}'),

('Preventive Maintenance', 'Scheduled comprehensive maintenance', 180,
 ARRAY['Advanced Maintenance', 'Technical Repair', 'Safety Procedures'],
 '{"items": ["Full system diagnostic", "Component testing", "Performance optimization", "Safety check"]}'),

('Emergency Repair', 'Urgent repair for critical issues', 120,
 ARRAY['Technical Repair', 'Emergency Response', 'Safety Procedures'],
 '{"items": ["Problem diagnosis", "Emergency repairs", "System testing", "Safety verification"]}'),

('Equipment Upgrade', 'System or component upgrade procedure', 240,
 ARRAY['System Installation', 'Technical Configuration', 'Safety Procedures'],
 '{"items": ["Pre-upgrade backup", "Component replacement", "System configuration", "Testing"]}');

-- Maintenance Teams
INSERT INTO maintenance_teams (name, description, is_active) VALUES
('Alpha Team', 'Primary maintenance team for northern region', true),
('Beta Team', 'Primary maintenance team for southern region', true),
('Emergency Response', 'Specialized team for urgent repairs', true),
('Installation Team', 'Dedicated equipment installation team', true);

-- Sample Towers
INSERT INTO towers (name, code, type_id, status_id, height, latitude, longitude, city, region) VALUES
('North Tower 1', 'NT001', 
 (SELECT type_id FROM tower_types WHERE name = 'Monopole'),
 (SELECT status_id FROM status_types WHERE category = 'tower' AND name = 'Active'),
 45.5, 14.5839, 121.0500, 'Makati', 'NCR'),

('South Tower 1', 'ST001',
 (SELECT type_id FROM tower_types WHERE name = 'Lattice'),
 (SELECT status_id FROM status_types WHERE category = 'tower' AND name = 'Active'),
 85.0, 14.5226, 121.0198, 'Taguig', 'NCR'),

('East Tower 1', 'ET001',
 (SELECT type_id FROM tower_types WHERE name = 'Guyed'),
 (SELECT status_id FROM status_types WHERE category = 'tower' AND name = 'Active'),
 120.0, 14.6042, 121.0813, 'Pasig', 'NCR');