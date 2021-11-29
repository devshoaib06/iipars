-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 02:45 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_app_routes`
--

CREATE TABLE `tb_app_routes` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(192) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `status` enum('d','s') NOT NULL DEFAULT 's'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_app_routes`
--

INSERT INTO `tb_app_routes` (`id`, `slug`, `controller`, `page_title`, `meta_keyword`, `meta_description`, `status`) VALUES
(1, 'home', 'home', 'Home', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 'd'),
(2, 'about', 'about', 'About', NULL, NULL, 'd'),
(3, 'login', 'login', 'login', NULL, NULL, 'd'),
(4, 'register', 'seller_register', 'Register', NULL, NULL, 'd'),
(5, 'seller-register', 'seller_register/register_first', 'Register', NULL, NULL, 'd'),
(6, 'register-first-submit', 'seller_register/register_first_submit', NULL, NULL, NULL, 's'),
(7, 'register-second', 'seller_register/register_second', 'Register', NULL, NULL, 'd'),
(8, 'register-second-submit', 'seller_register/register_second_submit', NULL, NULL, NULL, 's'),
(9, 'buyer-register-second', 'buyer_register/register_second', 'Register', NULL, NULL, 'd'),
(10, 'buyer-register-second-submit', 'buyer_register/register_second_submit', NULL, NULL, NULL, 's'),
(11, 'get-state-ajax', 'seller_register/get_state', NULL, NULL, NULL, 's'),
(12, 'register-fourth', 'seller_register/register_fourth', 'Register', NULL, NULL, 'd'),
(13, 'register-plan', 'seller_register/register_plan/$1', 'Register', NULL, NULL, 'd'),
(14, 'check-seller-username', 'seller_register/check_seller_username', NULL, NULL, NULL, 's'),
(15, 'plan-purchase', 'seller_register/plan_purchase', 'Register', NULL, NULL, 'd'),
(16, 'test', 'test_controller', 'Testing', NULL, NULL, 's'),
(17, 'make-plan-payment', 'seller_register/plan_payment', 'Payment', NULL, NULL, 'd'),
(18, 'plan-payment-success', 'seller_register/plan_payment_success', 'Payment Success', NULL, NULL, 'd'),
(19, 'register-finish', 'seller_register/register_finish', 'Register', NULL, NULL, 'd'),
(20, 'login-check', 'login/login_submit', NULL, NULL, NULL, 's'),
(21, 'logout', 'login/logout', NULL, NULL, NULL, 's'),
(22, 'seller-dashboard', 'seller', 'Seller', NULL, NULL, 'd'),
(23, 'seller-product', 'seller_product', 'Seller', NULL, NULL, 'd'),
(24, 'add-product', 'seller_product/add_product', 'Seller', NULL, NULL, 'd'),
(25, 'add-product-submit', 'seller_product/add_product_submit', NULL, NULL, NULL, 's'),
(26, 'edit-product', 'seller_product/edit_product/$1', 'Seller', NULL, NULL, 'd'),
(27, 'edit-product-submit', 'seller_product/edit_product_submit', NULL, NULL, NULL, 's'),
(28, 'delete_product_image', 'seller_product/delete_image_ajax', NULL, NULL, NULL, 's'),
(29, 'category', 'product', 'Product', NULL, NULL, 'd'),
(30, 'product-view-type-ajax', 'product/product_view_type_ajax', NULL, NULL, NULL, 's'),
(31, 'seller-account', 'seller_myaccount', 'My Account', NULL, NULL, 'd'),
(32, 'product', 'product/product_detail', 'Product', NULL, NULL, 'd'),
(33, 'seller-password', 'seller_myaccount/seller_password', 'Seller Password', NULL, NULL, 'd'),
(34, 'seller-payout', 'seller_myaccount/seller_payout', 'Seller payout', NULL, NULL, 'd'),
(35, 'seller-review', 'seller_myaccount/seller_review', 'Seller Review', NULL, NULL, 'd'),
(36, 'seller-newsletter', 'seller_myaccount/seller_newsletter', 'Seller newsletter', NULL, NULL, 'd'),
(37, 'seller-close-account', 'seller_myaccount/seller_close_account', 'Seller close account', NULL, NULL, 'd'),
(38, 'seller-add-payout', 'seller_myaccount/seller_add_payout', 'Seller add payout', NULL, NULL, 's'),
(39, 'state-dropdown', 'seller_myaccount/state_dropdown', 'State dropdown', NULL, NULL, 's'),
(40, 'payout-submit', 'seller_myaccount/payout_submit', 'Payout Submit', NULL, NULL, 's'),
(41, 'bank-status-check', 'seller_myaccount/bank_status_check/$1', 'Bank Status Check', NULL, NULL, 's'),
(42, 'bank-iban-delete', 'seller_myaccount/delete_bank_iban/$1', 'Bank iban delete', NULL, NULL, 's'),
(43, 'deactivate-account', 'seller_myaccount/deactivate_account', 'Deactivate Account', NULL, NULL, 's'),
(44, 'newsletter-subscription', 'seller_myaccount/newsletter_sub', 'Newsletter Subscription', NULL, NULL, 's'),
(45, 'add-cart', 'product/add_to_cart', 'Cart', NULL, NULL, 's'),
(46, 'Update-your-profile', 'seller_myaccount/update_profile', 'Update Your Profile', NULL, NULL, 's'),
(47, 'remove-cart-ajax', 'product/remove_cart_ajax', 'Cart', NULL, NULL, 's'),
(48, 'seller-stand', 'seller_stand', 'Seller_Stand', NULL, NULL, 'd'),
(49, 'seller-stand-submit', 'seller_stand/seller_stand_submit', 'Seller_Stand', NULL, NULL, 's'),
(50, 'delete-seller-image', 'seller_stand/delete_seller_image', NULL, NULL, NULL, 's'),
(51, 'delete-seller-video', 'seller_stand/delete_seller_video', NULL, NULL, NULL, 's'),
(52, 'cart', 'product/show_cart', 'Cart', NULL, NULL, 'd'),
(53, 'delete-seller-document', 'seller_stand/delete_seller_document', NULL, NULL, NULL, 's'),
(54, 'update-cart', 'product/update_cart', NULL, NULL, NULL, 's'),
(56, 'remove-cart', 'product/remove_cart', NULL, NULL, NULL, 's'),
(57, 'seller-stand-preview', 'seller_stand_preview', 'Seller_stand_preview', NULL, NULL, 'd'),
(59, 'document-download', 'seller_stand_preview/document_download/$1', NULL, NULL, NULL, 's'),
(60, 'seller-order', 'seller_order', 'Seller-order', NULL, NULL, 'd'),
(61, 'category-code', 'seller_product/category_code', 'Category Code', NULL, NULL, 'd'),
(62, 'category-commission', 'seller_product/category_commission', 'Category Comission', NULL, NULL, 'd'),
(63, 'seller-return', 'seller_order/seller_return', 'Seller-return', NULL, NULL, 'd'),
(64, 'delete-seller-logo', 'seller_stand/delete_seller_logo', NULL, NULL, NULL, 's'),
(65, 'delete_heading_image', 'seller_stand/delete_heading_image', NULL, NULL, NULL, 's'),
(66, 'add-wishlist', 'product/add_wishlist', NULL, NULL, NULL, 's'),
(67, 'check-login-ajax', 'product/check_login_ajax', NULL, NULL, NULL, 's'),
(68, 'seller-wishlist', 'seller_order/seller_wishlist', 'Wishlist', NULL, NULL, 'd'),
(69, 'delete-wishlist', 'seller_order/delete_wishlist', NULL, NULL, NULL, 's'),
(70, 'add-compare-product', 'product/add_compare_product', NULL, NULL, NULL, 's'),
(71, 'remove-compare-product', 'product/remove_compare_product', NULL, NULL, NULL, 's'),
(72, 'compare-product', 'product/compare_product', 'Compare', NULL, NULL, 'd'),
(73, 'product-review-submit', 'product/product_review_submit', NULL, NULL, NULL, 's'),
(74, 'seller-review-submit', 'seller_stand_preview/seller_review_submit', NULL, NULL, NULL, 's'),
(75, 'supplier', 'supplier', 'Supplier', NULL, NULL, 'd'),
(76, 'digital-marketing', 'supplier/digital_marketing', 'Seller-digital-marketing', NULL, NULL, 'd'),
(77, 'seller-logistics', 'supplier/seller_logistics', 'Seller-logistics', NULL, NULL, 'd'),
(78, 'content', 'content_page', 'Content', NULL, NULL, 'd'),
(79, 'seller-forgot-password', 'seller_register/forgot_password', 'Forgot Password', NULL, NULL, 'd'),
(80, 'seller-forgot-password-submit', 'seller_register/forgot_password_submit', 'Forgot Password', NULL, NULL, 's'),
(81, 'seller-contact-submit', 'seller_stand_preview/seller_contact_submit', NULL, NULL, NULL, 's'),
(82, 'email-forgot-password', 'seller_register/email_change_password', 'Forgot Password', NULL, NULL, 's'),
(83, 'email-forgot-password-submit', 'seller_register/email_change_password_submit', 'Forgot Password', NULL, NULL, 's'),
(84, 'password-reset', 'seller_myaccount/password_reset', NULL, NULL, NULL, 's'),
(85, 'seller-featured-product', 'seller_featured_product', 'Seller Featured Product', NULL, NULL, 'd'),
(86, 'seller-pickingaddress', 'seller_product/picking_address', 'Seller-pickingaddress', NULL, NULL, 'd'),
(87, 'seller-pickingaddressform', 'seller_product/picking_addressform', 'Seller-pickingaddressform', NULL, NULL, 'd'),
(88, 'state', 'seller_product/state_dropdown', NULL, NULL, NULL, 's'),
(89, 'picking-address-submit', 'seller_product/address_submit', NULL, NULL, NULL, 's'),
(90, 'pick-address-status', 'seller_product/address_status/$1', NULL, NULL, NULL, 's'),
(91, 'pick-address-delete', 'seller_product/address_delete/$1', NULL, NULL, NULL, 's'),
(92, 'signup', 'buyer_register', 'Register', NULL, NULL, 'd'),
(93, 'my-account', 'buyer_myaccount', 'My Account', NULL, NULL, 'd'),
(94, 'change-password', 'buyer_myaccount/buyer_password', 'Password', NULL, NULL, 'd'),
(95, 'newsletter', 'buyer_myaccount/buyer_newsletter', 'Newsletter', NULL, NULL, 'd'),
(96, 'buyer-close-account', 'buyer_myaccount/buyer_close_account', 'Close Account', NULL, NULL, 'd'),
(97, 'buyer-close-account-submit', 'buyer_myaccount/deactivate_account', NULL, NULL, NULL, 's'),
(98, 'newsletter-submit', 'buyer_myaccount/newsletter_sub', NULL, NULL, NULL, 's'),
(99, 'profile-submit', 'buyer_myaccount/update_profile', NULL, NULL, NULL, 's'),
(100, 'password-submit', 'buyer_myaccount/password_reset', NULL, NULL, NULL, 's'),
(101, 'buyer-order', 'buyer_order', 'My Order', NULL, NULL, 'd'),
(102, 'buyer-wishlist', 'buyer_order/buyer_wishlist', 'Wishlist', NULL, NULL, 'd'),
(103, 'delete-buyer-wishlist', 'buyer_order/delete_wishlist', NULL, NULL, NULL, 's'),
(104, 'buyer-register-submit', 'buyer_register/register_submit', 'Register', NULL, NULL, 's'),
(107, 'delete-product', 'seller_product/delete_product', NULL, NULL, NULL, 's'),
(108, 'contact-us', 'contact_us', 'Contact-us', NULL, NULL, 'd'),
(109, 'contact-form-submit', 'contact_us/contact_form_submit', NULL, NULL, NULL, 's'),
(110, 'page-not-found', 'page_not_found', 'Page not found', 'Page not found', 'Page not found', 'd'),
(111, 'h1s1kolhab', 'admin_front_login', NULL, NULL, NULL, 's'),
(112, 'services-category', 'services_category', NULL, NULL, NULL, 's'),
(113, 'services-manufacturer', 'services_category/manufacturer', NULL, NULL, NULL, 's'),
(114, 'services-brand', 'services_category/brand', NULL, NULL, NULL, 's'),
(115, 'services-condition', 'services_category/condition_note', NULL, NULL, NULL, 's'),
(116, 'bulk-product-upload', 'seller_product_bulk', 'Seller', NULL, NULL, 'd'),
(117, 'download-bulk-template', 'seller_product_bulk/download_template', NULL, NULL, NULL, 's'),
(118, 'bulk-upload-submit', 'seller_product_bulk/bulk_upload_submit', NULL, NULL, NULL, 's'),
(119, 'buyer-state-dropdown', 'buyer_myaccount/state_dropdown', NULL, NULL, NULL, 's'),
(120, 'validate-buyer-email', 'buyer_register/validate_buyer_email', NULL, NULL, NULL, 's'),
(121, 'about-us', 'content_page/about_us', 'About-Us', NULL, NULL, 's'),
(122, 'return-policy', 'content_page/return_policy', 'Return-policy', NULL, NULL, 's'),
(123, 'seller-protection', 'content_page/seller_protection', 'Seller-protection', NULL, NULL, 's'),
(124, 'term-condition', 'content_page/term_condition', 'Term-condition', NULL, NULL, 's'),
(125, 'privacy-policy', 'content_page/privacy_policy', 'Privacy-policy', NULL, NULL, 's'),
(126, 'faq', 'content_page/faq', 'Faq', NULL, NULL, 's'),
(127, 'warranty-policy', 'content_page/warranty_policy', 'Warranty-policy', NULL, NULL, 's'),
(128, 'checkout', 'product/checkout', 'Checkout', 'Checkout', 'Checkout', 's'),
(129, 'place-order', 'product/place_order', 'Place Order', 'Place Order', 'Place Order', 's'),
(130, 'payment-action', 'product/get_payment', 'Payment action', 'Payment action', 'Payment action', 's'),
(131, 'order-cancel', 'buyer_order/order_cancel', 'Order Cancel', NULL, NULL, 's'),
(132, 'order-delete', 'buyer_order/order_delete', 'Order delete', NULL, NULL, 's'),
(133, 'seller-order-details', 'seller/seller_order_details', 'Seller-order-details', NULL, NULL, 's'),
(134, 'apply-coupon-code', 'product/apply_coupon_code', 'Apply Coupon Code', 'Apply Coupon Code', NULL, 's'),
(135, 'sales-history', 'seller/sales_history', 'Sales history', 'Sales history', 'Sales history', 's'),
(136, 'sales-request', 'seller/sales_request', 'Sales request', 'Sales request', 'Sales request', 's');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_app_routes`
--
ALTER TABLE `tb_app_routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_app_routes`
--
ALTER TABLE `tb_app_routes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
