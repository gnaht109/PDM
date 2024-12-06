
CREATE TABLE IF NOT EXISTS users(
	user_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(255) NOT NULL,
    user_email varchar(255) NOT NULL UNIQUE,
    user_password varchar(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS products(
	product_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	product_name varchar(100) NOT NULL,
    product_category varchar(108) NOT NULL,
    product_description varchar(255) NOT NULL,
    product_image varchar(255) NOT NULL,
    product_image1 varchar(255) NOT NULL,
    product_image2 varchar(255) NOT NULL,
    product_image3 varchar(255) NOT NULL,
    product_image4 varchar(255) NOT NULL,
    product_price decimal(6,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders(
	order_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_cost decimal(6,2) NOT NULL,
    order_status varchar(100) NOT NULL DEFAULT 'on hold',
    user_id int(11) NOT NULL,
    user_phone int(11) NOT NULL,
    user_city varchar(255) NOT NULL,
    user_address varchar(255) NOT NULL,
    order_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS order_items(
	item_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id int(11) NOT NULL,
    product_id int(11) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_category varchar(255) NOT NULL,
    product_image varchar(255) NOT NULL,
    product_price decimal(6,2) NOT NULL,
    product_quantity int(11) NOT NULL,
    user_id int(11) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE IF NOT EXISTS payments(
	payment_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    payment_cost decimal(6,2) NOT NULL,
    payment_date DATETIME NOT NULL,
    card_number varchar(16) NOT NULL,
    card_holder varchar(255) NOT NULL,
    exp_year varchar(4) NOT NULL,
    exp_month varchar(2) NOT NULL,
    CVV varchar(3) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS bookings(
	booking_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id int(11) NOT NULL,
    booking_name varchar(255) NOT NULL,
    booking_email varchar(255) NOT NULL,
    booking_phone varchar(255) NOT NULL,
    booking_plate varchar(255) NOT NULL,
	booking_date datetime NOT NULL,
    booking_service varchar(255) NOT NULL,
    booking_status varchar(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
