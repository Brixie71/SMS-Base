-- Main database for Client Management System - (philtower_cms)

-- Drop existing tables
DROP TABLE IF EXISTS support_ticket_updates CASCADE;
DROP TABLE IF EXISTS support_tickets CASCADE;
DROP TABLE IF EXISTS service_requests CASCADE;
DROP TABLE IF EXISTS client_equipment CASCADE;
DROP TABLE IF EXISTS contract_services CASCADE;
DROP TABLE IF EXISTS service_types CASCADE;
DROP TABLE IF EXISTS contract_terms CASCADE;
DROP TABLE IF EXISTS client_contracts CASCADE;
DROP TABLE IF EXISTS client_contacts CASCADE;
DROP TABLE IF EXISTS client_documents CASCADE;
DROP TABLE IF EXISTS clients CASCADE;
DROP TABLE IF EXISTS client_types CASCADE;

-- Core Client Management
CREATE TABLE client_types (
    type_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    priority_level INT,
    is_active BOOLEAN DEFAULT true
);

CREATE TABLE clients (
    client_id SERIAL PRIMARY KEY,
    client_code VARCHAR(20) UNIQUE NOT NULL,
    company_name VARCHAR(200) NOT NULL,
    type_id INT REFERENCES client_types(type_id),
    status VARCHAR(50),
    account_manager_id INT,  -- Links to employees without FK
    registration_date DATE,
    website VARCHAR(255),
    notes TEXT,
    created_by INT,  -- Links to users without FK
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE client_contacts (
    contact_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(50),
    mobile VARCHAR(50),
    is_primary BOOLEAN DEFAULT false,
    is_technical BOOLEAN DEFAULT false,
    notes TEXT
);

CREATE TABLE client_documents (
    document_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    document_type VARCHAR(50),
    title VARCHAR(200),
    file_path TEXT,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiry_date DATE,
    status VARCHAR(50),
    uploaded_by INT,  -- Links to users without FK
    notes TEXT
);

-- Contract Management
CREATE TABLE client_contracts (
    contract_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    contract_code VARCHAR(50) UNIQUE NOT NULL,
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),
    contract_type VARCHAR(50),
    service_level VARCHAR(50),
    auto_renewal BOOLEAN DEFAULT false,
    renewal_notice_days INT,
    created_by INT,  -- Links to users without FK
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE service_types (
    service_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    sla_hours INT,  -- Response time in hours
    severity_level VARCHAR(20),
    maintenance_frequency INT,  -- Days between maintenance
    is_active BOOLEAN DEFAULT true
);

CREATE TABLE contract_services (
    contract_id INT REFERENCES client_contracts(contract_id),
    service_id INT REFERENCES service_types(service_id),
    quantity DECIMAL(8,2),
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),
    sla_terms TEXT,
    notes TEXT,
    PRIMARY KEY (contract_id, service_id)
);

CREATE TABLE contract_terms (
    term_id SERIAL PRIMARY KEY,
    contract_id INT REFERENCES client_contracts(contract_id),
    term_type VARCHAR(50),
    description TEXT,
    value TEXT,
    priority INT,
    is_mandatory BOOLEAN DEFAULT false
);

-- Equipment Management
CREATE TABLE client_equipment (
    equipment_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    contract_id INT REFERENCES client_contracts(contract_id),
    tower_equipment_id INT,  -- Links to tower_equipment without FK
    installation_date DATE,
    removal_date DATE,
    status VARCHAR(50),
    maintenance_schedule VARCHAR(100),
    last_maintenance_date DATE,
    next_maintenance_date DATE,
    notes TEXT
);

-- Service Management
CREATE TABLE service_requests (
    request_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    equipment_id INT REFERENCES client_equipment(equipment_id),
    request_type VARCHAR(50),
    priority VARCHAR(20),
    description TEXT,
    requested_by INT,  -- Links to client_contacts without FK
    requested_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    scheduled_date TIMESTAMP,
    completion_date TIMESTAMP,
    status VARCHAR(50),
    assigned_to INT,  -- Links to employees without FK
    resolution TEXT,
    response_time_minutes INT,  -- For SLA tracking
    notes TEXT
);

CREATE TABLE support_tickets (
    ticket_id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(client_id),
    equipment_id INT REFERENCES client_equipment(equipment_id),
    subject VARCHAR(200),
    description TEXT,
    priority VARCHAR(20),
    category VARCHAR(50),
    submitted_by INT,  -- Links to client_contacts without FK
    assigned_to INT,  -- Links to employees without FK
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    resolution TEXT,
    closed_at TIMESTAMP,
    response_time_minutes INT,  -- For SLA tracking
    resolution_time_minutes INT,  -- For SLA tracking
    sla_compliant BOOLEAN,
    closed_by INT  -- Links to users without FK
);

CREATE TABLE support_ticket_updates (
    update_id SERIAL PRIMARY KEY,
    ticket_id INT REFERENCES support_tickets(ticket_id),
    update_type VARCHAR(50),
    description TEXT,
    updated_by INT,  -- Links to users without FK
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50)
);

-- Create indexes
CREATE INDEX idx_clients_code ON clients(client_code);
CREATE INDEX idx_clients_manager ON clients(account_manager_id);
CREATE INDEX idx_contacts_client ON client_contacts(client_id);
CREATE INDEX idx_contracts_client ON client_contracts(client_id);
CREATE INDEX idx_contracts_code ON client_contracts(contract_code);
CREATE INDEX idx_equipment_client ON client_equipment(client_id);
CREATE INDEX idx_tickets_client ON support_tickets(client_id);
CREATE INDEX idx_service_requests_client ON service_requests(client_id);
CREATE INDEX idx_equipment_maintenance ON client_equipment(next_maintenance_date);
CREATE INDEX idx_tickets_sla ON support_tickets(created_at, response_time_minutes);
