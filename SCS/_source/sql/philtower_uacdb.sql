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

 Date: 18/02/2025 16:25:13
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
SELECT setval('"public"."audit_logs_id_seq"', 3, true);

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
