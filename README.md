# Create Core Values Table in SQL

```sql
CREATE TABLE core_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    family VARCHAR(255),
    freedom VARCHAR(255),
    financial_independence VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

# grant privileges

```sql
GRANT ALL PRIVILEGES ON {tablename.*} TO '{username}'@'{hostname}';
FLUSH PRIVILEGES;
```

# Create Core Values Table in SQL

```sql
CREATE TABLE vision_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    vision VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```