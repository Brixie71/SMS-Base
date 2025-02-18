# PhilTower Daa System Structure

## 1. User Access Control (UAC)
*Existing structure maintained as provided*

### Database Tables:
- **systems**
  - system_id (PK)
  - system_name
  - system_code (UK)
  - description
  - level_permissions (jsonb)

- **user_levels**
  - user_level_id (PK)
  - name (UK)
  - description
  - system_id (FK)

- **departments**
  - department_id (PK)
  - department_name (UK)
  - description

- **users**
  - user_id (PK)
  - username (UK)
  - email (UK)
  - password_hash
  - first_name
  - last_name
  - date_created
  - last_login
  - is_active
  - user_level_id
  - reports_to_user_id (FK)
  - photo
  - mobile_number
  - department_id (FK)
  - profile

- **user_level_assignments**
  - assignment_id (PK)
  - system_id (FK)
  - user_id (FK)
  - user_level_id (FK)
  - assigned_by (FK)
  - created_at

- **user_level_permissions**
  - user_level_id (PK, FK)
  - table_name (PK)
  - permission

- **audit_logs**
  - id (PK)
  - date_time
  - script
  - user
  - action
  - table
  - field
  - key_value
  - old_value
  - new_value

- **notifications**
  - id (PK)
  - timestamp
  - type
  - target
  - user_id (FK)
  - subject
  - body
  - link
  - from_system
  - is_read
  - created_at

## 2. Core Asset Management System (CAMS)

### Main Tables:
- **towers**
  - tower_id (PK)
  - name
  - latitude
  - longitude
  - height
  - status_id (FK)
  - created_by (FK to users)
  - updated_by (FK to users)

- **tower_specifications**
  - spec_id (PK)
  - tower_id (FK)
  - spec_type_id (FK)
  - value
  - unit_id (FK)

- **specification_types**
  - spec_type_id (PK)
  - name
  - description
  - data_type
  - unit_category_id (FK)

- **measurement_units**
  - unit_id (PK)
  - name
  - symbol
  - category_id (FK)

- **unit_categories**
  - category_id (PK)
  - name
  - description

- **tower_equipment**
  - equipment_id (PK)
  - tower_id (FK)
  - client_id (FK)
  - equipment_type_id (FK)
  - model_id (FK)
  - serial_number
  - installation_date
  - warranty_expiry
  - status_id (FK)
  - maintained_by (FK to users)
  - installed_by (FK to users)

- **equipment_types**
  - type_id (PK)
  - name
  - category_id (FK)
  - description

- **equipment_models**
  - model_id (PK)
  - manufacturer_id (FK)
  - model_name
  - specifications

- **equipment_specifications**
  - spec_id (PK)
  - equipment_id (FK)
  - spec_type_id (FK)
  - value
  - unit_id (FK)

- **manufacturers**
  - manufacturer_id (PK)
  - name
  - contact_info
  - support_contact

### Maintenance Tables:
- **maintenance_schedules**
  - schedule_id (PK)
  - tower_id (FK)
  - equipment_id (FK)
  - scheduled_date
  - maintenance_type_id (FK)
  - status_id (FK)
  - team_id (FK)
  - priority_id (FK)
  - notes

- **maintenance_types**
  - type_id (PK)
  - name
  - description
  - frequency
  - required_skills

- **maintenance_teams**
  - team_id (PK)
  - name
  - supervisor_id (FK to users)
  - zone_id (FK)

- **team_members**
  - team_id (FK)
  - user_id (FK)
  - role_id (FK)

- **maintenance_logs**
  - log_id (PK)
  - schedule_id (FK)
  - performed_by (FK to users)
  - approved_by (FK to users)
  - start_time
  - end_time
  - status_id (FK)

- **maintenance_findings**
  - finding_id (PK)
  - log_id (FK)
  - finding_type_id (FK)
  - description
  - severity_id (FK)

- **maintenance_actions**
  - action_id (PK)
  - log_id (FK)
  - action_type_id (FK)
  - description
  - result

- **parts_used**
  - usage_id (PK)
  - log_id (FK)
  - part_id (FK)
  - quantity
  - cost

## 3. Security and Monitoring System (SMS)

### Zone Management:
- **security_zones**
  - zone_id (PK)
  - tower_id (FK)
  - name
  - security_level_id (FK)
  - created_by (FK to users)
  - updated_by (FK to users)

- **zone_boundaries**
  - boundary_id (PK)
  - zone_id (FK)
  - latitude
  - longitude
  - sequence_no

- **security_levels**
  - level_id (PK)
  - name
  - description
  - clearance_requirements

- **zone_access_requirements**
  - zone_id (FK)
  - requirement_id (FK)
  - value

### Access Control:
- **access_points**
  - point_id (PK)
  - zone_id (FK)
  - type_id (FK)
  - status_id (FK)
  - location_desc
  - maintained_by (FK to users)

- **access_point_types**
  - type_id (PK)
  - name
  - description
  - capabilities

- **access_point_capabilities**
  - point_id (FK)
  - capability_id (FK)
  - status
  - last_verified

- **access_logs**
  - log_id (PK)
  - point_id (FK)
  - user_id (FK)
  - timestamp
  - access_type_id (FK)
  - verification_method_id (FK)
  - status_id (FK)

### Incident Management:
- **incidents**
  - incident_id (PK)
  - tower_id (FK)
  - occurred_at
  - reported_by (FK)
  - type_id (FK)
  - priority_id (FK)
  - status_id (FK)
  - description

- **incident_types**
  - type_id (PK)
  - category_id (FK)
  - name
  - description
  - response_priority

- **incident_status_history**
  - history_id (PK)
  - incident_id (FK)
  - status_id (FK)
  - changed_by (FK)
  - changed_at
  - notes

## 4. Client and Service Management System (CSMS)

### Client Management:
- **clients**
  - client_id (PK)
  - company_name
  - status_id (FK)
  - account_manager_id (FK)
  - created_by (FK)

- **client_contacts**
  - contact_id (PK)
  - client_id (FK)
  - name
  - position
  - contact_type_id (FK)
  - value
  - is_primary

- **client_preferences**
  - preference_id (PK)
  - client_id (FK)
  - preference_type_id (FK)
  - value

### Contract Management:
- **client_contracts**
  - contract_id (PK)
  - client_id (FK)
  - start_date
  - end_date
  - type_id (FK)
  - status_id (FK)
  - base_rate
  - created_by (FK)
  - approved_by (FK)

- **contract_terms**
  - term_id (PK)
  - contract_id (FK)
  - term_type_id (FK)
  - value
  - notes

- **service_levels**
  - sla_id (PK)
  - contract_id (FK)
  - service_type_id (FK)
  - created_by (FK)
  - reviewer_id (FK)

- **sla_requirements**
  - requirement_id (PK)
  - sla_id (FK)
  - metric_id (FK)
  - target_value
  - minimum_value
  - penalty_rate

## 5. Location and Coverage System (LCS)

### Coverage Management:
- **coverage_areas**
  - area_id (PK)
  - tower_id (FK)
  - type_id (FK)
  - analyzed_by (FK)
  - created_by (FK)

- **area_boundaries**
  - boundary_id (PK)
  - area_id (FK)
  - latitude
  - longitude
  - sequence_no

- **coverage_specifications**
  - spec_id (PK)
  - area_id (FK)
  - spec_type_id (FK)
  - value
  - unit_id (FK)

### Zone Management:
- **maintenance_zones**
  - zone_id (PK)
  - area_id (FK)
  - name
  - team_id (FK)
  - supervisor_id (FK)
  - priority_id (FK)

- **zone_boundaries**
  - boundary_id (PK)
  - zone_id (FK)
  - latitude
  - longitude
  - sequence_no

### Common Status Tables:
- **status_types**
  - status_id (PK)
  - category
  - name
  - description
  - is_active

- **priority_levels**
  - priority_id (PK)
  - name
  - description
  - response_time
  - escalation_time


# 6. Enhanced Security and Employee Management Structure

## 1. CCTV and Equipment Configuration

### Primary Tables:
- **cctv_cameras**
  - camera_id (PK)
  - equipment_id (FK to tower_equipment)
  - name
  - location_id (FK)
  - model_id (FK)
  - status_id (FK)
  - ip_address
  - mac_address
  - stream_url
  - api_config (JSON) -- Stores API endpoints, authentication, and specific settings
  - device_config (JSON) -- Stores device-specific settings
  - installed_by (FK to users)
  - last_maintained_by (FK to users)

- **camera_models**
  - model_id (PK)
  - manufacturer_id (FK)
  - model_name
  - camera_type_id (FK)
  - supported_features (eg: PTZ, facial recognition, etc)
  - api_template (JSON) -- Standard API configuration template for this model

- **camera_zones**
  - zone_id (PK)
  - camera_id (FK)
  - zone_type_id (FK)
  - coordinates_poly -- Detection/monitoring zone
  - sensitivity_level
  - active_schedule_id (FK)

- **recording_settings**
  - setting_id (PK)
  - camera_id (FK)
  - resolution
  - fps
  - quality_level
  - retention_days
  - motion_trigger
  - schedule_id (FK)

## 2. Enhanced Employee Management

### Primary Tables:
- **employees** -- Extends users table
  - employee_id (PK)
  - user_id (FK to users)
  - employee_type_id (FK)
  - employee_no
  - hire_date
  - status_id (FK)
  - department_id (FK)
  - position_id (FK)
  - supervisor_id (FK to employees)
  - work_schedule_id (FK)
  - emergency_contact
  - blood_type
  - medical_conditions

- **employee_types**
  - type_id (PK)
  - name (e.g., Regular, Contractor, Security, Maintenance)
  - description
  - access_level_id (FK)
  - benefits_eligible
  - security_clearance_id (FK)

- **positions**
  - position_id (PK)
  - title
  - department_id (FK)
  - level
  - description
  - responsibilities
  - required_clearance_id (FK)

### Biometric Data Management:
- **employee_biometrics**
  - bio_id (PK)
  - employee_id (FK)
  - bio_type_id (FK)
  - template_data (binary/blob)
  - enrolled_date
  - enrolled_by (FK to users)
  - status_id (FK)
  - last_updated
  - quality_score

- **biometric_types**
  - type_id (PK)
  - name (e.g., Face, Fingerprint, RFID)
  - description
  - template_format
  - min_quality_score

- **facial_recognition_data**
  - face_id (PK)
  - employee_id (FK)
  - primary_template (binary/blob)
  - alternative_templates (binary/blob)
  - enrolled_date
  - last_updated
  - confidence_threshold
  - status_id (FK)

### Access Management:
- **access_cards**
  - card_id (PK)
  - employee_id (FK)
  - card_number
  - card_type_id (FK)
  - issue_date
  - expiry_date
  - status_id (FK)
  - issued_by (FK to users)

- **access_permissions**
  - permission_id (PK)
  - employee_id (FK)
  - zone_id (FK)
  - schedule_id (FK)
  - granted_by (FK to users)
  - grant_date
  - expiry_date
  - status_id (FK)

### Work Schedules:
- **work_schedules**
  - schedule_id (PK)
  - name
  - type_id (FK)
  - description
  - effective_date
  - status_id (FK)

- **schedule_details**
  - detail_id (PK)
  - schedule_id (FK)
  - day_of_week
  - start_time
  - end_time
  - break_duration

## 3. Configuration Management

### Equipment Configuration Tables:
- **equipment_configs**
  - config_id (PK)
  - equipment_id (FK)
  - config_type_id (FK)
  - config_data (JSON) -- Stores equipment-specific configuration
  - version
  - applied_date
  - applied_by (FK to users)
  - is_active

- **config_templates**
  - template_id (PK)
  - equipment_type_id (FK)
  - manufacturer_id (FK)
  - template_name
  - template_data (JSON)
  - version
  - is_current

### Sample JSON Structures:

```sql
-- Example CCTV API Configuration JSON
{
    "api_version": "2.1",
    "auth": {
        "type": "basic|oauth|token",
        "credentials": {
            "username": "api_user",
            "password": "encrypted_password",
            "token_url": "https://api.camera.com/token"
        }
    },
    "endpoints": {
        "stream": "/api/stream",
        "ptz": "/api/ptz",
        "recording": "/api/recording",
        "motion": "/api/motion"
    },
    "features": {
        "facial_recognition": {
            "enabled": true,
            "min_confidence": 0.85,
            "detection_zones": ["zone1", "zone2"]
        },
        "motion_detection": {
            "sensitivity": 75,
            "zones": ["entry", "perimeter"]
        }
    }
}

-- Example Device Configuration JSON
{
    "video": {
        "resolution": "1920x1080",
        "fps": 30,
        "bitrate": "4mbps",
        "codec": "H.264"
    },
    "network": {
        "primary_dns": "8.8.8.8",
        "secondary_dns": "8.8.4.4",
        "gateway": "192.168.1.1",
        "subnet_mask": "255.255.255.0"
    },
    "storage": {
        "mode": "continuous|motion",
        "retention_days": 30,
        "max_storage_gb": 500
    }
}
```
