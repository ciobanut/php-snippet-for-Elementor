<?php

add_filter( 'elementor/widget/render_content', 'insert_wp_variables_in_content' );
function insert_wp_variables_in_content( $content ) {
	
	// This function replaces the placeholders like {{ post_content }} with the corresponding property values from the $post object in the $content variable. Make sure to replace {{ post_id }}, {{ post_title }}, etc., with the appropriate placeholders you want to replace in your content.

	// searching in content for this {{ key }} pattern
 	$pattern = '/\{\{.*?\}\}/';

	// check if content have the string that match your pattern
 	if (preg_match($pattern, $content)) {

		global $post; // Make sure you have this line to access the $post global variable		
		global $current_user; // Get the current user object

		// WooCommerce global variables
		global $product;
		global $woocommerce;
		global $cart;
		global $order;
		global $customer;

		$placeholders = [
			
			// Insert {{ post_title }} or any other property into your content in Elementor to echo post title or what you choose

			// Post

			'{{ post_id }}'					=>	$post->ID,
			'{{ post_title }}'				=>	esc_html($post->post_title),
			'{{ post_content }}'			=>	wpautop($post->post_content),
			'{{ post_excerpt }}'			=>	esc_html($post->post_excerpt),
			'{{ post_date }}'				=>	$post->post_date,
			'{{ post_date_gmt }}'			=>	$post->post_date_gmt,
			'{{ post_author }}'				=>	$post->post_author,
			'{{ post_status }}'				=>	$post->post_status,
			'{{ post_type }}'				=>	$post->post_type,
			'{{ post_name }}'				=>	$post->post_name,
			'{{ post_parent }}'				=>	$post->post_parent,
			'{{ post_modified }}'			=>	$post->post_modified,
			'{{ post_modified_gmt }}'		=>	$post->post_modified_gmt,
			'{{ post_content_filtered }}'	=>	wpautop($post->post_content_filtered),
			'{{ post_mime_type }}'			=>	$post->post_mime_type,
			'{{ comment_count }}'			=>	$post->comment_count,

			// Custom fields 

			'{{ custom_field_value }}'		=>	get_post_meta($post->ID, 'custom_field_value', true),
			// feel free to add here any custom field you need

			// Tags

			'{{ tags }}'					=>	strip_tags( get_the_term_list( $post->ID, 'post_tag', '', ', ') ),
			'{{ tags_with_link }}'			=>	get_the_term_list( $post->ID, 'post_tag', '', ', '),

			// Categories 

			'{{ categories }}'				=>	strip_tags( get_the_term_list( $post->ID, 'category', '', ', ') ),
			'{{ categories_with_link }}'	=>	get_the_term_list( $post->ID, 'category', '', ', '),

			// Current User 

			'{{ user_ID }}'					=>	 $current_user->ID,
			'{{ user_login }}'				=>	 $current_user->user_login,
			'{{ user_email }}'				=>	 $current_user->user_email,
			'{{ user_nicename }}'			=>	 $current_user->user_nicename,
			'{{ display_name }}'			=>	 $current_user->display_name,
			'{{ user_registered }}'			=>	 $current_user->user_registered,
			'{{ user_url }}'				=>	 $current_user->user_url,
			'{{ user_status }}'				=>	 $current_user->user_status,
			'{{ user_roles }}'				=>	 implode(', ', $current_user->roles),
			'{{ user_firstname }}'			=>	 $current_user->user_firstname,
			'{{ user_lastname }}'			=>	 $current_user->user_lastname,
			'{{ user_description }}'		=>	 $current_user->description,

			// WooCommerce product

			// '{{ product_id }}' 				=> $product->get_id(),
			// '{{ product_name }}' 			=> $product->get_name(),
			// '{{ product_price }}' 			=> $product->get_price(),
			// '{{ product_description }}' 	=> $product->get_description(),
			// '{{ product_permalink }}' 		=> $product->get_permalink(),

			// // WooCommerce $woocommerce

			// '{{ currency_symbol }}' 		=> get_woocommerce_currency_symbol(),
			// '{{ shop_url }}' 				=> get_permalink(woocommerce_get_page_id('shop')),
			// '{{ checkout_url }}' 			=> wc_get_checkout_url(),
			// '{{ my_account_url }}' 			=> wc_get_account_endpoint_url('dashboard'),

			// // WooCommerce $cart

			// '{{ cart_total }}' 				=> $cart->get_cart_total(),
			// '{{ cart_count }}' 				=> $cart->get_cart_contents_count(),
			// '{{ cart_items }}' 				=> $cart->get_cart(),

			// // WooCommerce $order

			// '{{ order_id }}' 				=> $order->get_id(),
			// '{{ order_number }}' 			=> $order->get_order_number(),
			// '{{ order_status }}' 			=> $order->get_status(),
			// '{{ order_billing_address }}' 	=> $order->get_billing_address(),
			// '{{ order_shipping_address }}' 	=> $order->get_shipping_address(),
			// '{{ billing_email }}' 			=> $order->get_billing_email(),
			// '{{ billing_phone }}' 			=> $order->get_billing_phone(),
			// '{{ payment_method }}' 			=> $order->get_payment_method(),
			// '{{ payment_method_title }}' 	=> $order->get_payment_method_title(),

			// // WooCommerce $customer

			// '{{ customer_id }}' 			=> $customer->get_id(),
			// '{{ user_id }}' 				=> $customer->get_user_id(),
			// '{{ customer_billing_address }}' => $customer->get_billing_address(),
			// '{{ customer_shipping_address }}' => $customer->get_shipping_address(),
			// '{{ customer_email }}' 			=> $customer->get_email(),
			// '{{ customer_first_name }}' 	=> $customer->get_first_name(),
			// '{{ customer_last_name }}' 		=> $customer->get_last_name(),
			// '{{ customer_username }}' 		=> $customer->get_username(),
		];

		foreach ($placeholders as $placeholder => $value) {
			$content = str_replace($placeholder, $value, $content);
		}
	}

	return $content;
}

?>