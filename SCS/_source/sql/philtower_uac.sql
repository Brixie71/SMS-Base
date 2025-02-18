/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : PostgreSQL
 Source Server Version : 160006 (160006)
 Source Host           : localhost:5432
 Source Catalog        : philtower_uac
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160006 (160006)
 File Encoding         : 65001

 Date: 18/02/2025 17:26:05
*/


-- ----------------------------
-- Sequence structure for audit_logs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."audit_logs_id_seq";
CREATE SEQUENCE "public"."audit_logs_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for departments_department_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."departments_department_id_seq";
CREATE SEQUENCE "public"."departments_department_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for systems_system_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."systems_system_id_seq";
CREATE SEQUENCE "public"."systems_system_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_level_assignments_assignment_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_level_assignments_assignment_id_seq";
CREATE SEQUENCE "public"."user_level_assignments_assignment_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_user_id_seq";
CREATE SEQUENCE "public"."users_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for audit_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."audit_logs";
CREATE TABLE "public"."audit_logs" (
  "id" int4 NOT NULL DEFAULT nextval('audit_logs_id_seq'::regclass),
  "date_time" timestamp(6) NOT NULL,
  "script" varchar(255) COLLATE "pg_catalog"."default",
  "user" varchar(255) COLLATE "pg_catalog"."default",
  "action" varchar(255) COLLATE "pg_catalog"."default",
  "table" varchar(255) COLLATE "pg_catalog"."default",
  "field" varchar(255) COLLATE "pg_catalog"."default",
  "key_value" text COLLATE "pg_catalog"."default",
  "old_value" text COLLATE "pg_catalog"."default",
  "new_value" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of audit_logs
-- ----------------------------
INSERT INTO "public"."audit_logs" VALUES (1, '2025-02-17 04:13:04', '/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (2, '2025-02-17 06:02:32', '/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (3, '2025-02-17 06:25:33', '/UAC/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (4, '2025-02-17 07:04:41', '/UAC/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (5, '2025-02-17 07:44:57', '/UAC/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (6, '2025-02-17 08:15:06', '/UAC/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (7, '2025-02-17 08:24:00', '/UAC/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (8, '2025-02-17 09:19:26', '/UAC/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (9, '2025-02-17 23:06:47', '/SCS/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (10, '2025-02-18 02:33:14', '/SCS/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (11, '2025-02-18 02:33:37', '/UAC/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (12, '2025-02-18 02:34:27', '/SCS/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (13, '2025-02-18 03:57:46', '/SCS/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (14, '2025-02-18 06:50:54', '/SCS/login', '-1', 'login', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (15, '2025-02-18 08:15:51', '/SCS/logout', '-1', 'logout', '::1', '', '', '', '');
INSERT INTO "public"."audit_logs" VALUES (16, '2025-02-18 08:15:55', '/SCS/login', '-1', 'login', '::1', '', '', '', '');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS "public"."departments";
CREATE TABLE "public"."departments" (
  "department_id" int4 NOT NULL DEFAULT nextval('departments_department_id_seq'::regclass),
  "department_name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO "public"."departments" VALUES (1, 'Command Center', 'Central tower operations control');
INSERT INTO "public"."departments" VALUES (2, 'Tower Operations', 'Tower maintenance and management');
INSERT INTO "public"."departments" VALUES (3, 'Security Operations', 'Security and surveillance management');
INSERT INTO "public"."departments" VALUES (4, 'Client Services', 'Client relations and contract management');
INSERT INTO "public"."departments" VALUES (5, 'Technical Support', 'Equipment and technical maintenance');
INSERT INTO "public"."departments" VALUES (6, 'System Administration', 'System and security administration');
INSERT INTO "public"."departments" VALUES (7, 'Human Resources', 'Personnel and training management');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS "public"."notifications";
CREATE TABLE "public"."notifications" (
  "id" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "timestamp" timestamptz(6),
  "type" varchar(20) COLLATE "pg_catalog"."default",
  "target" varchar(50) COLLATE "pg_catalog"."default",
  "user_id" int4,
  "subject" varchar(200) COLLATE "pg_catalog"."default",
  "body" text COLLATE "pg_catalog"."default",
  "link" varchar(255) COLLATE "pg_catalog"."default",
  "from_system" varchar(20) COLLATE "pg_catalog"."default",
  "is_read" bool DEFAULT false,
  "created_at" timestamptz(6) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for systems
-- ----------------------------
DROP TABLE IF EXISTS "public"."systems";
CREATE TABLE "public"."systems" (
  "system_id" int4 NOT NULL DEFAULT nextval('systems_system_id_seq'::regclass),
  "system_name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "system_code" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default",
  "level_permissions" jsonb
)
;

-- ----------------------------
-- Records of systems
-- ----------------------------
INSERT INTO "public"."systems" VALUES (1, 'PRIME-UAC', 'UAC', 'User Access Control - Authentication & Security System', NULL);
INSERT INTO "public"."systems" VALUES (2, 'PRIME-CCS', 'CCS', 'Command Center System - Tower Operations Hub', NULL);
INSERT INTO "public"."systems" VALUES (3, 'PRIME-AMS', 'AMS', 'Asset Management System - Tower & Equipment Management', NULL);
INSERT INTO "public"."systems" VALUES (4, 'PRIME-SCS', 'SCS', 'Security Control System - Access & Surveillance Platform', NULL);
INSERT INTO "public"."systems" VALUES (5, 'PRIME-CMS', 'CMS', 'Client Management System - Client & Contract Management', NULL);
INSERT INTO "public"."systems" VALUES (6, 'PRIME-EMS', 'EMS', 'Employee Management System - Personnel & Training Control', NULL);
INSERT INTO "public"."systems" VALUES (7, 'PRIME-RAS', 'RAS', 'Real-Time Analytics System - Business Intelligence Hub', NULL);

-- ----------------------------
-- Table structure for user_level_assignments
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_level_assignments";
CREATE TABLE "public"."user_level_assignments" (
  "assignment_id" int4 NOT NULL DEFAULT nextval('user_level_assignments_assignment_id_seq'::regclass),
  "system_id" int4,
  "user_id" int4,
  "user_level_id" int4,
  "assigned_by" int4,
  "created_at" timestamp(6)
)
;

-- ----------------------------
-- Records of user_level_assignments
-- ----------------------------
INSERT INTO "public"."user_level_assignments" VALUES (1, 2, 1, 2001, -1, '2025-02-17 11:39:44.818407');
INSERT INTO "public"."user_level_assignments" VALUES (2, 2, 2, 2002, -1, '2025-02-17 11:39:44.818407');
INSERT INTO "public"."user_level_assignments" VALUES (3, 3, 3, 3001, -1, '2025-02-17 11:39:44.818407');
INSERT INTO "public"."user_level_assignments" VALUES (4, 4, 5, 4001, -1, '2025-02-17 11:39:44.818407');
INSERT INTO "public"."user_level_assignments" VALUES (5, 5, 7, 5001, -1, '2025-02-17 11:39:44.818407');

-- ----------------------------
-- Table structure for user_level_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_level_permissions";
CREATE TABLE "public"."user_level_permissions" (
  "user_level_id" int4 NOT NULL,
  "table_name" varchar(80) COLLATE "pg_catalog"."default" NOT NULL,
  "permission" int4 NOT NULL
)
;

-- ----------------------------
-- Records of user_level_permissions
-- ----------------------------
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}audit_logs', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}systems', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}user_level_assignments', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}user_level_permissions', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}user_levels', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}users', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}aggregated_audit_logs', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}MainDashboard.php', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}departments', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}notifications', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}UserManagement.php', 0);
INSERT INTO "public"."user_level_permissions" VALUES (-2, '{UAC}UserAccess.php', 0);

-- ----------------------------
-- Table structure for user_levels
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_levels";
CREATE TABLE "public"."user_levels" (
  "user_level_id" int4 NOT NULL,
  "name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default",
  "system_id" int4
)
;

-- ----------------------------
-- Records of user_levels
-- ----------------------------
INSERT INTO "public"."user_levels" VALUES (-1, 'System Administrator', 'Complete system control and configuration access', 1);
INSERT INTO "public"."user_levels" VALUES (1001, 'Security Manager', 'Security policy and access management', 1);
INSERT INTO "public"."user_levels" VALUES (1002, 'User Manager', 'Basic user management and support', 1);
INSERT INTO "public"."user_levels" VALUES (2000, 'Command Center Admin', 'Full command center system control', 2);
INSERT INTO "public"."user_levels" VALUES (2001, 'Operations Manager', 'Tower operations management', 2);
INSERT INTO "public"."user_levels" VALUES (2002, 'Control Room Operator', 'Tower monitoring and alert management', 2);
INSERT INTO "public"."user_levels" VALUES (3000, 'Asset System Admin', 'Full asset management system control', 3);
INSERT INTO "public"."user_levels" VALUES (3001, 'Maintenance Manager', 'Equipment maintenance oversight', 3);
INSERT INTO "public"."user_levels" VALUES (3002, 'Technical Officer', 'Equipment maintenance and monitoring', 3);
INSERT INTO "public"."user_levels" VALUES (4000, 'Security System Admin', 'Full security system administration', 4);
INSERT INTO "public"."user_levels" VALUES (4001, 'Security Supervisor', 'Security team management', 4);
INSERT INTO "public"."user_levels" VALUES (4002, 'Security Officer', 'Access control and surveillance', 4);
INSERT INTO "public"."user_levels" VALUES (5000, 'Client System Admin', 'Full client system administration', 5);
INSERT INTO "public"."user_levels" VALUES (5001, 'Account Manager', 'Client relationship management', 5);
INSERT INTO "public"."user_levels" VALUES (5002, 'Service Coordinator', 'Client service management', 5);
INSERT INTO "public"."user_levels" VALUES (6000, 'HR System Admin', 'Full HR system administration', 6);
INSERT INTO "public"."user_levels" VALUES (6001, 'HR Manager', 'Personnel management and training', 6);
INSERT INTO "public"."user_levels" VALUES (6002, 'HR Officer', 'Employee records and scheduling', 6);
INSERT INTO "public"."user_levels" VALUES (7000, 'Analytics Admin', 'Full analytics system administration', 7);
INSERT INTO "public"."user_levels" VALUES (7001, 'Business Analyst', 'Data analysis and reporting', 7);
INSERT INTO "public"."user_levels" VALUES (7002, 'Report Viewer', 'Report access and basic analysis', 7);
INSERT INTO "public"."user_levels" VALUES (-2, 'Anonymous', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "user_id" int4 NOT NULL DEFAULT nextval('users_user_id_seq'::regclass),
  "username" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "password_hash" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "first_name" varchar(50) COLLATE "pg_catalog"."default",
  "middle_name" varchar(50) COLLATE "pg_catalog"."default",
  "last_name" varchar(50) COLLATE "pg_catalog"."default",
  "date_created" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "last_login" timestamp(6),
  "is_active" bool DEFAULT true,
  "user_level_id" varchar(255) COLLATE "pg_catalog"."default",
  "reports_to_user_id" int4,
  "photo" varchar(255) COLLATE "pg_catalog"."default",
  "mobile_number" varchar(20) COLLATE "pg_catalog"."default",
  "department_id" int4,
  "profile" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (-1, 'prime.admin', 'admin@philtower.com', '$2y$10$encrypted_hash_here', 'PRIME', NULL, 'Administrator', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 6, NULL);
INSERT INTO "public"."users" VALUES (4, 'tech.officer1', 'tech.officer1@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', NULL, 'Officer 1', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 2, NULL);
INSERT INTO "public"."users" VALUES (6, 'security.officer1', 'security.officer1@philtower.com', '$2y$10$encrypted_hash_here', 'Security', NULL, 'Officer 1', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 3, NULL);
INSERT INTO "public"."users" VALUES (8, 'service.coordinator', 'service.coordinator@philtower.com', '$2y$10$encrypted_hash_here', 'Service', NULL, 'Coordinator', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 4, NULL);
INSERT INTO "public"."users" VALUES (9, 'tech.supervisor', 'tech.supervisor@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', NULL, 'Supervisor', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 5, NULL);
INSERT INTO "public"."users" VALUES (10, 'tech.support1', 'tech.support1@philtower.com', '$2y$10$encrypted_hash_here', 'Technical', NULL, 'Support 1', '2025-02-17 11:39:44.818407', NULL, 't', NULL, NULL, NULL, NULL, 5, NULL);
INSERT INTO "public"."users" VALUES (1, 'cmd.manager', 'cmd.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Command', NULL, 'Manager', '2025-02-17 11:39:44.818407', NULL, 't', '2001', NULL, NULL, NULL, 1, NULL);
INSERT INTO "public"."users" VALUES (2, 'cmd.operator1', 'cmd.operator1@philtower.com', '$2y$10$encrypted_hash_here', 'Command', NULL, 'Operator 1', '2025-02-17 11:39:44.818407', NULL, 't', '2002', NULL, NULL, NULL, 1, NULL);
INSERT INTO "public"."users" VALUES (3, 'tower.manager', 'tower.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Tower', NULL, 'Manager', '2025-02-17 11:39:44.818407', NULL, 't', '3001', NULL, NULL, NULL, 2, NULL);
INSERT INTO "public"."users" VALUES (5, 'security.supervisor', 'security.supervisor@philtower.com', '$2y$10$encrypted_hash_here', 'Security', NULL, 'Supervisor', '2025-02-17 11:39:44.818407', NULL, 't', '4001', NULL, NULL, NULL, 3, NULL);
INSERT INTO "public"."users" VALUES (7, 'client.manager', 'client.manager@philtower.com', '$2y$10$encrypted_hash_here', 'Client', NULL, 'Manager', '2025-02-17 11:39:44.818407', NULL, 't', '5001', NULL, NULL, NULL, 4, NULL);

-- ----------------------------
-- Function structure for update_user_levels
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."update_user_levels"();
CREATE FUNCTION "public"."update_user_levels"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
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
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- View structure for aggregated_audit_logs
-- ----------------------------
DROP VIEW IF EXISTS "public"."aggregated_audit_logs";
CREATE VIEW "public"."aggregated_audit_logs" AS  SELECT to_char(date(date_time)::timestamp with time zone, 'YYYY-MM-DD'::text) AS action_date,
    script,
    "user",
    action,
    "table",
        CASE
            WHEN action::text = 'A'::text THEN 'Add'::character varying
            WHEN action::text = 'D'::text THEN 'Delete'::character varying
            WHEN action::text = 'U'::text THEN 'Update'::character varying
            WHEN action::text = 'login'::text THEN 'Login'::character varying
            WHEN action::text = 'logout'::text THEN 'Logout'::character varying
            ELSE action
        END AS action_type,
        CASE
            WHEN action::text = ANY (ARRAY['A'::character varying, 'D'::character varying, 'U'::character varying]::text[]) THEN string_agg((((field::text || ': '::text) ||
            CASE
                WHEN field::text = ANY (ARRAY['date_created'::character varying, 'last_login'::character varying]::text[]) THEN COALESCE(to_char(NULLIF(old_value, ''::text)::timestamp without time zone, 'YYYY-MM-DD HH24:MI:SS'::text), ''::text)
                ELSE COALESCE(old_value, ''::text)
            END) ||
            CASE
                WHEN action::text = 'U'::text THEN ' -> '::text
                ELSE ''::text
            END) ||
            CASE
                WHEN field::text = ANY (ARRAY['date_created'::character varying, 'last_login'::character varying]::text[]) THEN COALESCE(to_char(NULLIF(new_value, ''::text)::timestamp without time zone, 'YYYY-MM-DD HH24:MI:SS'::text), ''::text)
                ELSE COALESCE(new_value, ''::text)
            END, '
'::text ORDER BY id)
            WHEN action::text = ANY (ARRAY['login'::character varying, 'logout'::character varying]::text[]) THEN max(key_value)
            ELSE string_agg((((field::text || ': '::text) || COALESCE(old_value, ''::text)) || ' -> '::text) || COALESCE(new_value, ''::text), '
'::text ORDER BY id)
        END AS details,
    count(*) AS action_count,
    min(id) AS aggregated_id
   FROM audit_logs
  GROUP BY (date(date_time)), script, "user", action, "table"
  ORDER BY (min(id)) DESC;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."audit_logs_id_seq"
OWNED BY "public"."audit_logs"."id";
SELECT setval('"public"."audit_logs_id_seq"', 16, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."departments_department_id_seq"
OWNED BY "public"."departments"."department_id";
SELECT setval('"public"."departments_department_id_seq"', 7, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."systems_system_id_seq"
OWNED BY "public"."systems"."system_id";
SELECT setval('"public"."systems_system_id_seq"', 7, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."user_level_assignments_assignment_id_seq"
OWNED BY "public"."user_level_assignments"."assignment_id";
SELECT setval('"public"."user_level_assignments_assignment_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_user_id_seq"
OWNED BY "public"."users"."user_id";
SELECT setval('"public"."users_user_id_seq"', 10, true);

-- ----------------------------
-- Primary Key structure for table audit_logs
-- ----------------------------
ALTER TABLE "public"."audit_logs" ADD CONSTRAINT "audit_logs_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table departments
-- ----------------------------
ALTER TABLE "public"."departments" ADD CONSTRAINT "departments_department_name_key" UNIQUE ("department_name");

-- ----------------------------
-- Primary Key structure for table departments
-- ----------------------------
ALTER TABLE "public"."departments" ADD CONSTRAINT "departments_pkey" PRIMARY KEY ("department_id");

-- ----------------------------
-- Indexes structure for table notifications
-- ----------------------------
CREATE INDEX "idx_notifications_is_read" ON "public"."notifications" USING btree (
  "is_read" "pg_catalog"."bool_ops" ASC NULLS LAST
);
CREATE INDEX "idx_notifications_target" ON "public"."notifications" USING btree (
  "target" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);
CREATE INDEX "idx_notifications_type" ON "public"."notifications" USING btree (
  "type" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);
CREATE INDEX "idx_notifications_user_id" ON "public"."notifications" USING btree (
  "user_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table notifications
-- ----------------------------
ALTER TABLE "public"."notifications" ADD CONSTRAINT "notifications_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table systems
-- ----------------------------
CREATE INDEX "idx_systems_code" ON "public"."systems" USING btree (
  "system_code" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table systems
-- ----------------------------
ALTER TABLE "public"."systems" ADD CONSTRAINT "systems_system_code_key" UNIQUE ("system_code");

-- ----------------------------
-- Primary Key structure for table systems
-- ----------------------------
ALTER TABLE "public"."systems" ADD CONSTRAINT "systems_pkey" PRIMARY KEY ("system_id");

-- ----------------------------
-- Indexes structure for table user_level_assignments
-- ----------------------------
CREATE INDEX "idx_user_level_assignments_level" ON "public"."user_level_assignments" USING btree (
  "user_level_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
CREATE INDEX "idx_user_level_assignments_user" ON "public"."user_level_assignments" USING btree (
  "user_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Triggers structure for table user_level_assignments
-- ----------------------------
CREATE TRIGGER "user_level_assignment_delete" AFTER DELETE ON "public"."user_level_assignments"
FOR EACH ROW
EXECUTE PROCEDURE "public"."update_user_levels"();
CREATE TRIGGER "user_level_assignment_insert" AFTER INSERT ON "public"."user_level_assignments"
FOR EACH ROW
EXECUTE PROCEDURE "public"."update_user_levels"();
CREATE TRIGGER "user_level_assignment_update" AFTER UPDATE ON "public"."user_level_assignments"
FOR EACH ROW
EXECUTE PROCEDURE "public"."update_user_levels"();

-- ----------------------------
-- Uniques structure for table user_level_assignments
-- ----------------------------
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_user_id_user_level_id_key" UNIQUE ("user_id", "user_level_id");

-- ----------------------------
-- Primary Key structure for table user_level_assignments
-- ----------------------------
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_pkey" PRIMARY KEY ("assignment_id");

-- ----------------------------
-- Indexes structure for table user_level_permissions
-- ----------------------------
CREATE INDEX "idx_user_level_permissions_level" ON "public"."user_level_permissions" USING btree (
  "user_level_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
CREATE INDEX "idx_user_level_permissions_table" ON "public"."user_level_permissions" USING btree (
  "table_name" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table user_level_permissions
-- ----------------------------
ALTER TABLE "public"."user_level_permissions" ADD CONSTRAINT "user_level_permissions_pkey" PRIMARY KEY ("user_level_id", "table_name");

-- ----------------------------
-- Indexes structure for table user_levels
-- ----------------------------
CREATE INDEX "idx_user_levels_system" ON "public"."user_levels" USING btree (
  "system_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table user_levels
-- ----------------------------
ALTER TABLE "public"."user_levels" ADD CONSTRAINT "user_levels_name_key" UNIQUE ("name");

-- ----------------------------
-- Primary Key structure for table user_levels
-- ----------------------------
ALTER TABLE "public"."user_levels" ADD CONSTRAINT "user_levels_pkey" PRIMARY KEY ("user_level_id");

-- ----------------------------
-- Indexes structure for table users
-- ----------------------------
CREATE INDEX "idx_users_email" ON "public"."users" USING btree (
  "email" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);
CREATE INDEX "idx_users_reports_to" ON "public"."users" USING btree (
  "reports_to_user_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
CREATE INDEX "idx_users_username" ON "public"."users" USING btree (
  "username" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_username_key" UNIQUE ("username");
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_key" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("user_id");

-- ----------------------------
-- Foreign Keys structure for table user_level_assignments
-- ----------------------------
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_assigned_by_fkey" FOREIGN KEY ("assigned_by") REFERENCES "public"."users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_system_id_fkey" FOREIGN KEY ("system_id") REFERENCES "public"."systems" ("system_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."user_level_assignments" ADD CONSTRAINT "user_level_assignments_user_level_id_fkey" FOREIGN KEY ("user_level_id") REFERENCES "public"."user_levels" ("user_level_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table user_level_permissions
-- ----------------------------
ALTER TABLE "public"."user_level_permissions" ADD CONSTRAINT "user_level_permissions_user_level_id_fkey" FOREIGN KEY ("user_level_id") REFERENCES "public"."user_levels" ("user_level_id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table user_levels
-- ----------------------------
ALTER TABLE "public"."user_levels" ADD CONSTRAINT "user_levels_system_id_fkey" FOREIGN KEY ("system_id") REFERENCES "public"."systems" ("system_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_department_id_fkey" FOREIGN KEY ("department_id") REFERENCES "public"."departments" ("department_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."users" ADD CONSTRAINT "users_reports_to_user_id_fkey" FOREIGN KEY ("reports_to_user_id") REFERENCES "public"."users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
