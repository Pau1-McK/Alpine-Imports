INSERT INTO users (username, password, email, full_name)
VALUES
('john_doe', 'password123', 'john_doe@example.com', 'John Doe'),
('jane_smith', 'qwerty456', 'jane_smith@example.com', 'Jane Smith'),
('bob_johnson', 'abc123xyz', 'bob_johnson@example.com', 'Bob Johnson');

-- Sample data for transactions table
INSERT INTO transactions (user_id, amount, description, date)
VALUES
(1, 50.00, 'Payment for services', '2022-01-01'),
(2, 100.00, 'Product purchase', '2022-01-02'),
(1, 25.00, 'Refund for cancelled service', '2022-01-03'),
(3, 75.00, 'Donation to charity', '2022-01-04'),
(2, 50.00, 'Payment for subscription', '2022-01-05'),
(1, 200.00, 'Large purchase', '2022-01-06');