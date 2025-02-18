-- Drop indexes if they exist
DROP INDEX IF EXISTS idx_notifications_target;
DROP INDEX IF EXISTS idx_notifications_type;
DROP INDEX IF EXISTS idx_notifications_is_read;
DROP INDEX IF EXISTS idx_notifications_user_id;

-- Drop table if exists
DROP TABLE IF EXISTS notifications;

-- Create notifications table
CREATE TABLE notifications (
    id VARCHAR(50) PRIMARY KEY,
    timestamp TIMESTAMP WITH TIME ZONE,
    type VARCHAR(20),
    target VARCHAR(50),
    user_id INT,  -- Optional user ID, no foreign key constraint
    subject VARCHAR(200),
    body TEXT,
    link VARCHAR(255),
    from_system VARCHAR(20),
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Create indexes
CREATE INDEX idx_notifications_target ON notifications(target);
CREATE INDEX idx_notifications_type ON notifications(type);
CREATE INDEX idx_notifications_is_read ON notifications(is_read);
CREATE INDEX idx_notifications_user_id ON notifications(user_id);