/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : PostgreSQL
 Source Server Version : 160006 (160006)
 Source Host           : localhost:5432
 Source Catalog        : philtower_sms
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160006 (160006)
 File Encoding         : 65001

 Date: 19/02/2025 07:28:16
*/


-- ----------------------------
-- Sequence structure for access_cards_card_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."access_cards_card_id_seq";
CREATE SEQUENCE "public"."access_cards_card_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for access_logs_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."access_logs_log_id_seq";
CREATE SEQUENCE "public"."access_logs_log_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for access_points_point_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."access_points_point_id_seq";
CREATE SEQUENCE "public"."access_points_point_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for cctv_cameras_camera_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cctv_cameras_camera_id_seq";
CREATE SEQUENCE "public"."cctv_cameras_camera_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for cctv_recordings_recording_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cctv_recordings_recording_id_seq";
CREATE SEQUENCE "public"."cctv_recordings_recording_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for facial_recognition_logs_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."facial_recognition_logs_log_id_seq";
CREATE SEQUENCE "public"."facial_recognition_logs_log_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for incident_responses_response_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."incident_responses_response_id_seq";
CREATE SEQUENCE "public"."incident_responses_response_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for incident_updates_update_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."incident_updates_update_id_seq";
CREATE SEQUENCE "public"."incident_updates_update_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for incidents_incident_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."incidents_incident_id_seq";
CREATE SEQUENCE "public"."incidents_incident_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for patrol_checkpoints_checkpoint_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."patrol_checkpoints_checkpoint_id_seq";
CREATE SEQUENCE "public"."patrol_checkpoints_checkpoint_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for patrol_logs_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."patrol_logs_log_id_seq";
CREATE SEQUENCE "public"."patrol_logs_log_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for patrol_routes_route_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."patrol_routes_route_id_seq";
CREATE SEQUENCE "public"."patrol_routes_route_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for security_zones_zone_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."security_zones_zone_id_seq";
CREATE SEQUENCE "public"."security_zones_zone_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for access_cards
-- ----------------------------
DROP TABLE IF EXISTS "public"."access_cards";
CREATE TABLE "public"."access_cards" (
  "card_id" int4 NOT NULL DEFAULT nextval('access_cards_card_id_seq'::regclass),
  "card_number" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "employee_id" int4,
  "issue_date" date,
  "expiry_date" date,
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "access_level" int4,
  "issued_by" int4,
  "is_active" bool DEFAULT true,
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of access_cards
-- ----------------------------

-- ----------------------------
-- Table structure for access_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."access_logs";
CREATE TABLE "public"."access_logs" (
  "log_id" int4 NOT NULL DEFAULT nextval('access_logs_log_id_seq'::regclass),
  "point_id" int4,
  "card_id" int4,
  "employee_id" int4,
  "timestamp" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "access_type" varchar(20) COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "verification_method" varchar(50) COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of access_logs
-- ----------------------------

-- ----------------------------
-- Table structure for access_points
-- ----------------------------
DROP TABLE IF EXISTS "public"."access_points";
CREATE TABLE "public"."access_points" (
  "point_id" int4 NOT NULL DEFAULT nextval('access_points_point_id_seq'::regclass),
  "zone_id" int4,
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "type" varchar(50) COLLATE "pg_catalog"."default",
  "location_description" text COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "ip_address" varchar(45) COLLATE "pg_catalog"."default",
  "last_maintained" timestamp(6),
  "maintained_by" int4,
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of access_points
-- ----------------------------
INSERT INTO "public"."access_points" VALUES (1, NULL, 'Main Gate', 'Gate', NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."access_points" VALUES (2, NULL, 'Equipment Room Door', 'Door', NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."access_points" VALUES (3, NULL, 'Emergency Exit', 'Door', NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."access_points" VALUES (4, NULL, 'Parking Entrance', 'Gate', NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."access_points" VALUES (5, NULL, 'Visitor Entry', 'Turnstile', NULL, 'Active', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for cctv_cameras
-- ----------------------------
DROP TABLE IF EXISTS "public"."cctv_cameras";
CREATE TABLE "public"."cctv_cameras" (
  "camera_id" int4 NOT NULL DEFAULT nextval('cctv_cameras_camera_id_seq'::regclass),
  "zone_id" int4,
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "location_description" text COLLATE "pg_catalog"."default",
  "type" varchar(50) COLLATE "pg_catalog"."default",
  "model" varchar(100) COLLATE "pg_catalog"."default",
  "ip_address" varchar(45) COLLATE "pg_catalog"."default",
  "rtsp_url" text COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "last_maintained" timestamp(6),
  "maintained_by" int4,
  "config" jsonb,
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of cctv_cameras
-- ----------------------------
INSERT INTO "public"."cctv_cameras" VALUES (1, NULL, 'Main Gate Cam', NULL, 'PTZ', NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."cctv_cameras" VALUES (2, NULL, 'Equipment Room Cam', NULL, 'Fixed', NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."cctv_cameras" VALUES (3, NULL, 'Parking Area Cam', NULL, 'PTZ', NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."cctv_cameras" VALUES (4, NULL, 'Perimeter Cam 1', NULL, 'Fixed', NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO "public"."cctv_cameras" VALUES (5, NULL, 'Lobby Cam', NULL, 'Fixed', NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for cctv_recordings
-- ----------------------------
DROP TABLE IF EXISTS "public"."cctv_recordings";
CREATE TABLE "public"."cctv_recordings" (
  "recording_id" int4 NOT NULL DEFAULT nextval('cctv_recordings_recording_id_seq'::regclass),
  "camera_id" int4,
  "start_time" timestamp(6),
  "end_time" timestamp(6),
  "file_path" text COLLATE "pg_catalog"."default",
  "file_size" int8,
  "retention_days" int4,
  "recording_type" varchar(50) COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of cctv_recordings
-- ----------------------------

-- ----------------------------
-- Table structure for facial_recognition_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."facial_recognition_logs";
CREATE TABLE "public"."facial_recognition_logs" (
  "log_id" int4 NOT NULL DEFAULT nextval('facial_recognition_logs_log_id_seq'::regclass),
  "camera_id" int4,
  "employee_id" int4,
  "timestamp" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "confidence_score" numeric(5,2),
  "location_description" text COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "image_path" text COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of facial_recognition_logs
-- ----------------------------

-- ----------------------------
-- Table structure for incident_responses
-- ----------------------------
DROP TABLE IF EXISTS "public"."incident_responses";
CREATE TABLE "public"."incident_responses" (
  "response_id" int4 NOT NULL DEFAULT nextval('incident_responses_response_id_seq'::regclass),
  "incident_id" int4,
  "responder_id" int4,
  "response_time" timestamp(6),
  "action_taken" text COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of incident_responses
-- ----------------------------

-- ----------------------------
-- Table structure for incident_updates
-- ----------------------------
DROP TABLE IF EXISTS "public"."incident_updates";
CREATE TABLE "public"."incident_updates" (
  "update_id" int4 NOT NULL DEFAULT nextval('incident_updates_update_id_seq'::regclass),
  "incident_id" int4,
  "updated_by" int4,
  "update_time" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of incident_updates
-- ----------------------------

-- ----------------------------
-- Table structure for incidents
-- ----------------------------
DROP TABLE IF EXISTS "public"."incidents";
CREATE TABLE "public"."incidents" (
  "incident_id" int4 NOT NULL DEFAULT nextval('incidents_incident_id_seq'::regclass),
  "zone_id" int4,
  "reported_by" int4,
  "incident_time" timestamp(6),
  "type" varchar(50) COLLATE "pg_catalog"."default",
  "priority" varchar(20) COLLATE "pg_catalog"."default",
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "location_description" text COLLATE "pg_catalog"."default",
  "initial_response" text COLLATE "pg_catalog"."default",
  "created_at" timestamp(6) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Records of incidents
-- ----------------------------

-- ----------------------------
-- Table structure for patrol_checkpoints
-- ----------------------------
DROP TABLE IF EXISTS "public"."patrol_checkpoints";
CREATE TABLE "public"."patrol_checkpoints" (
  "checkpoint_id" int4 NOT NULL DEFAULT nextval('patrol_checkpoints_checkpoint_id_seq'::regclass),
  "route_id" int4,
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "location_description" text COLLATE "pg_catalog"."default",
  "sequence_number" int4,
  "required_action" text COLLATE "pg_catalog"."default",
  "scan_code" varchar(50) COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of patrol_checkpoints
-- ----------------------------

-- ----------------------------
-- Table structure for patrol_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."patrol_logs";
CREATE TABLE "public"."patrol_logs" (
  "log_id" int4 NOT NULL DEFAULT nextval('patrol_logs_log_id_seq'::regclass),
  "route_id" int4,
  "guard_id" int4,
  "start_time" timestamp(6),
  "end_time" timestamp(6),
  "status" varchar(50) COLLATE "pg_catalog"."default",
  "notes" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of patrol_logs
-- ----------------------------

-- ----------------------------
-- Table structure for patrol_routes
-- ----------------------------
DROP TABLE IF EXISTS "public"."patrol_routes";
CREATE TABLE "public"."patrol_routes" (
  "route_id" int4 NOT NULL DEFAULT nextval('patrol_routes_route_id_seq'::regclass),
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default",
  "estimated_duration" int4,
  "created_by" int4,
  "is_active" bool DEFAULT true
)
;

-- ----------------------------
-- Records of patrol_routes
-- ----------------------------
INSERT INTO "public"."patrol_routes" VALUES (1, 'Perimeter Route', NULL, 30, NULL, 't');
INSERT INTO "public"."patrol_routes" VALUES (2, 'Equipment Check Route', NULL, 45, NULL, 't');
INSERT INTO "public"."patrol_routes" VALUES (3, 'Night Patrol Route', NULL, 60, NULL, 't');

-- ----------------------------
-- Table structure for security_zones
-- ----------------------------
DROP TABLE IF EXISTS "public"."security_zones";
CREATE TABLE "public"."security_zones" (
  "zone_id" int4 NOT NULL DEFAULT nextval('security_zones_zone_id_seq'::regclass),
  "tower_id" int4,
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default",
  "security_level" int4,
  "access_requirements" text COLLATE "pg_catalog"."default",
  "is_active" bool DEFAULT true,
  "created_by" int4,
  "created_at" timestamp(6) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Records of security_zones
-- ----------------------------
INSERT INTO "public"."security_zones" VALUES (1, NULL, 'High Security Area', 'Critical infrastructure areas requiring highest security', 5, NULL, 't', NULL, '2025-02-18 13:17:13.706165');
INSERT INTO "public"."security_zones" VALUES (2, NULL, 'Equipment Room', 'Areas containing sensitive equipment', 4, NULL, 't', NULL, '2025-02-18 13:17:13.706165');
INSERT INTO "public"."security_zones" VALUES (3, NULL, 'Office Space', 'General office and administrative areas', 3, NULL, 't', NULL, '2025-02-18 13:17:13.706165');
INSERT INTO "public"."security_zones" VALUES (4, NULL, 'Parking Area', 'Vehicle parking and access areas', 2, NULL, 't', NULL, '2025-02-18 13:17:13.706165');
INSERT INTO "public"."security_zones" VALUES (5, NULL, 'Public Access', 'Areas accessible to visitors', 1, NULL, 't', NULL, '2025-02-18 13:17:13.706165');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."access_cards_card_id_seq"
OWNED BY "public"."access_cards"."card_id";
SELECT setval('"public"."access_cards_card_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."access_logs_log_id_seq"
OWNED BY "public"."access_logs"."log_id";
SELECT setval('"public"."access_logs_log_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."access_points_point_id_seq"
OWNED BY "public"."access_points"."point_id";
SELECT setval('"public"."access_points_point_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."cctv_cameras_camera_id_seq"
OWNED BY "public"."cctv_cameras"."camera_id";
SELECT setval('"public"."cctv_cameras_camera_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."cctv_recordings_recording_id_seq"
OWNED BY "public"."cctv_recordings"."recording_id";
SELECT setval('"public"."cctv_recordings_recording_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."facial_recognition_logs_log_id_seq"
OWNED BY "public"."facial_recognition_logs"."log_id";
SELECT setval('"public"."facial_recognition_logs_log_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."incident_responses_response_id_seq"
OWNED BY "public"."incident_responses"."response_id";
SELECT setval('"public"."incident_responses_response_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."incident_updates_update_id_seq"
OWNED BY "public"."incident_updates"."update_id";
SELECT setval('"public"."incident_updates_update_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."incidents_incident_id_seq"
OWNED BY "public"."incidents"."incident_id";
SELECT setval('"public"."incidents_incident_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."patrol_checkpoints_checkpoint_id_seq"
OWNED BY "public"."patrol_checkpoints"."checkpoint_id";
SELECT setval('"public"."patrol_checkpoints_checkpoint_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."patrol_logs_log_id_seq"
OWNED BY "public"."patrol_logs"."log_id";
SELECT setval('"public"."patrol_logs_log_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."patrol_routes_route_id_seq"
OWNED BY "public"."patrol_routes"."route_id";
SELECT setval('"public"."patrol_routes_route_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."security_zones_zone_id_seq"
OWNED BY "public"."security_zones"."zone_id";
SELECT setval('"public"."security_zones_zone_id_seq"', 5, true);

-- ----------------------------
-- Indexes structure for table access_cards
-- ----------------------------
CREATE INDEX "idx_access_cards_employee" ON "public"."access_cards" USING btree (
  "employee_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table access_cards
-- ----------------------------
ALTER TABLE "public"."access_cards" ADD CONSTRAINT "access_cards_card_number_key" UNIQUE ("card_number");

-- ----------------------------
-- Primary Key structure for table access_cards
-- ----------------------------
ALTER TABLE "public"."access_cards" ADD CONSTRAINT "access_cards_pkey" PRIMARY KEY ("card_id");

-- ----------------------------
-- Indexes structure for table access_logs
-- ----------------------------
CREATE INDEX "idx_access_logs_timestamp" ON "public"."access_logs" USING btree (
  "timestamp" "pg_catalog"."timestamp_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table access_logs
-- ----------------------------
ALTER TABLE "public"."access_logs" ADD CONSTRAINT "access_logs_pkey" PRIMARY KEY ("log_id");

-- ----------------------------
-- Indexes structure for table access_points
-- ----------------------------
CREATE INDEX "idx_access_points_zone" ON "public"."access_points" USING btree (
  "zone_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table access_points
-- ----------------------------
ALTER TABLE "public"."access_points" ADD CONSTRAINT "access_points_pkey" PRIMARY KEY ("point_id");

-- ----------------------------
-- Indexes structure for table cctv_cameras
-- ----------------------------
CREATE INDEX "idx_cameras_zone" ON "public"."cctv_cameras" USING btree (
  "zone_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table cctv_cameras
-- ----------------------------
ALTER TABLE "public"."cctv_cameras" ADD CONSTRAINT "cctv_cameras_pkey" PRIMARY KEY ("camera_id");

-- ----------------------------
-- Primary Key structure for table cctv_recordings
-- ----------------------------
ALTER TABLE "public"."cctv_recordings" ADD CONSTRAINT "cctv_recordings_pkey" PRIMARY KEY ("recording_id");

-- ----------------------------
-- Indexes structure for table facial_recognition_logs
-- ----------------------------
CREATE INDEX "idx_facial_logs_timestamp" ON "public"."facial_recognition_logs" USING btree (
  "timestamp" "pg_catalog"."timestamp_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table facial_recognition_logs
-- ----------------------------
ALTER TABLE "public"."facial_recognition_logs" ADD CONSTRAINT "facial_recognition_logs_pkey" PRIMARY KEY ("log_id");

-- ----------------------------
-- Primary Key structure for table incident_responses
-- ----------------------------
ALTER TABLE "public"."incident_responses" ADD CONSTRAINT "incident_responses_pkey" PRIMARY KEY ("response_id");

-- ----------------------------
-- Primary Key structure for table incident_updates
-- ----------------------------
ALTER TABLE "public"."incident_updates" ADD CONSTRAINT "incident_updates_pkey" PRIMARY KEY ("update_id");

-- ----------------------------
-- Indexes structure for table incidents
-- ----------------------------
CREATE INDEX "idx_incidents_time" ON "public"."incidents" USING btree (
  "incident_time" "pg_catalog"."timestamp_ops" ASC NULLS LAST
);
CREATE INDEX "idx_incidents_zone" ON "public"."incidents" USING btree (
  "zone_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table incidents
-- ----------------------------
ALTER TABLE "public"."incidents" ADD CONSTRAINT "incidents_pkey" PRIMARY KEY ("incident_id");

-- ----------------------------
-- Primary Key structure for table patrol_checkpoints
-- ----------------------------
ALTER TABLE "public"."patrol_checkpoints" ADD CONSTRAINT "patrol_checkpoints_pkey" PRIMARY KEY ("checkpoint_id");

-- ----------------------------
-- Primary Key structure for table patrol_logs
-- ----------------------------
ALTER TABLE "public"."patrol_logs" ADD CONSTRAINT "patrol_logs_pkey" PRIMARY KEY ("log_id");

-- ----------------------------
-- Primary Key structure for table patrol_routes
-- ----------------------------
ALTER TABLE "public"."patrol_routes" ADD CONSTRAINT "patrol_routes_pkey" PRIMARY KEY ("route_id");

-- ----------------------------
-- Indexes structure for table security_zones
-- ----------------------------
CREATE INDEX "idx_zones_tower" ON "public"."security_zones" USING btree (
  "tower_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table security_zones
-- ----------------------------
ALTER TABLE "public"."security_zones" ADD CONSTRAINT "security_zones_pkey" PRIMARY KEY ("zone_id");

-- ----------------------------
-- Foreign Keys structure for table access_logs
-- ----------------------------
ALTER TABLE "public"."access_logs" ADD CONSTRAINT "access_logs_card_id_fkey" FOREIGN KEY ("card_id") REFERENCES "public"."access_cards" ("card_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."access_logs" ADD CONSTRAINT "access_logs_point_id_fkey" FOREIGN KEY ("point_id") REFERENCES "public"."access_points" ("point_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table access_points
-- ----------------------------
ALTER TABLE "public"."access_points" ADD CONSTRAINT "access_points_zone_id_fkey" FOREIGN KEY ("zone_id") REFERENCES "public"."security_zones" ("zone_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table cctv_cameras
-- ----------------------------
ALTER TABLE "public"."cctv_cameras" ADD CONSTRAINT "cctv_cameras_zone_id_fkey" FOREIGN KEY ("zone_id") REFERENCES "public"."security_zones" ("zone_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table cctv_recordings
-- ----------------------------
ALTER TABLE "public"."cctv_recordings" ADD CONSTRAINT "cctv_recordings_camera_id_fkey" FOREIGN KEY ("camera_id") REFERENCES "public"."cctv_cameras" ("camera_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table facial_recognition_logs
-- ----------------------------
ALTER TABLE "public"."facial_recognition_logs" ADD CONSTRAINT "facial_recognition_logs_camera_id_fkey" FOREIGN KEY ("camera_id") REFERENCES "public"."cctv_cameras" ("camera_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table incident_responses
-- ----------------------------
ALTER TABLE "public"."incident_responses" ADD CONSTRAINT "incident_responses_incident_id_fkey" FOREIGN KEY ("incident_id") REFERENCES "public"."incidents" ("incident_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table incident_updates
-- ----------------------------
ALTER TABLE "public"."incident_updates" ADD CONSTRAINT "incident_updates_incident_id_fkey" FOREIGN KEY ("incident_id") REFERENCES "public"."incidents" ("incident_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table incidents
-- ----------------------------
ALTER TABLE "public"."incidents" ADD CONSTRAINT "incidents_zone_id_fkey" FOREIGN KEY ("zone_id") REFERENCES "public"."security_zones" ("zone_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table patrol_checkpoints
-- ----------------------------
ALTER TABLE "public"."patrol_checkpoints" ADD CONSTRAINT "patrol_checkpoints_route_id_fkey" FOREIGN KEY ("route_id") REFERENCES "public"."patrol_routes" ("route_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table patrol_logs
-- ----------------------------
ALTER TABLE "public"."patrol_logs" ADD CONSTRAINT "patrol_logs_route_id_fkey" FOREIGN KEY ("route_id") REFERENCES "public"."patrol_routes" ("route_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
