add_filter( 'elementor/widget/render_content', 'insert_wp_variables_in_content' );
function insert_wp_variables_in_content( $content ) {
	
	// This function replaces the placeholders like {{ post_content }} with the corresponding property values from the $post object in the $content variable. Make sure to replace {{ post_id }}, {{ post_title }}, etc., with the appropriate placeholders you want to replace in your content.



	// searching in content for this {{ $variable }} pattern
 	$pattern = '/\{\{.*?\}\}/';

	// check if content have the string that match your pattern
 	if (preg_match($pattern, $content)) {

		global $post; // Make sure you have this line to access the $post global variable		
		global $current_user; // Get the current user object
		global $product;
		global $order;
		global $customer;

		$placeholders = [
			
			// Insert {{ post_title }} or any other property into your content in Elementor or Gutenberg to echo post title or what you choose
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

			'{{ custom_field_value }}'		=>	get_post_meta($post->ID, 'custom_field_value', true),
			// feel free to add here any custom field you need

			'{{ tags }}'					=>	get_terms_list($post->ID, 'tag'),
			'{{ tags_with_link }}'			=>	get_terms_list_with_link($post->ID, 'tag'),

			'{{ categories }}'				=>	get_terms_list($post->ID, 'cat'),
			'{{ categories_with_link }}'	=>	get_terms_list_with_link($post->ID, 'cat'),

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
			'{{ product_id }}'				=>	 $product->get_id(),
			'{{ product_name }}'			=>	 $product->get_name(),
			'{{ product_sku }}'				=>	 $product->get_sku(),
			'{{ product_price }}'			=>	 $product->get_price(),
			'{{ product_regular_price }}'	=>	 $product->get_regular_price(),
			'{{ product_sale_price }}'		=>	 $product->get_sale_price(),
			'{{ product_stock_quantity }}'	=>	 $product->get_stock_quantity(),
			'{{ product_permalink }}'		=>	 $product->get_permalink(),
			'{{ product_short_description }}'=>	 $product->get_short_description(),
			'{{ product_description }}'		=>	 $product->get_description(),

			// WooCommerce order
			'{{ order_id }}'				=>	 $order->get_id(),
			'{{ order_number }}'			=>	 $order->get_order_number(),
			'{{ order_status }}'			=>	 $order->get_status(),
			'{{ billing_address }}'			=>	 $order->get_billing_address(),
			'{{ shipping_address }}'		=>	 $order->get_shipping_address(),
			'{{ billing_email }}'			=>	 $order->get_billing_email(),
			'{{ billing_phone }}'			=>	 $order->get_billing_phone(),
			'{{ payment_method }}'			=>	 $order->get_payment_method(),
			'{{ payment_method_title }}'	=>	 $order->get_payment_method_title(),

			// WooCommerce customer
			'{{ customer_id }}'				=>	 $customer->get_id(),
			'{{ user_id }}'					=>	 $customer->get_user_id(),
			'{{ billing_address }}'			=>	 $customer->get_billing_address(),
			'{{ shipping_address }}'		=>	 $customer->get_shipping_address(),
			'{{ customer_email }}'			=>	 $customer->get_email(),
			'{{ customer_first_name }}'		=>	 $customer->get_first_name(),
			'{{ customer_last_name }}'		=>	 $customer->get_last_name(),
			'{{ customer_username }}'		=>	 $customer->get_username(),
		];

		foreach ($placeholders as $placeholder => $value) {
			$content = str_replace($placeholder, $value, $content);
		}
	}

	return $content;
}


function get_terms_list($post_id, $taxonomy) {
	// Get the terms associated with the current post in the Loop
	$terms = get_the_terms($post_id, $taxonomy); // Replace 'tag' with the actual taxonomy name

	if ($terms && !is_wp_error($terms)) {
		$post_terms = '';
		foreach ($terms as $term) {
			// Access term properties like $term->term_id, $term->name, $term->slug, etc.
			$post_terms .= $term->name.', ';
		}
	}
	return $post_terms;
}

function get_terms_list_with_link($post_id, $taxonomy) {
	// Get the terms associated with the current post in the Loop
	$terms = get_the_terms($post_id, $taxonomy); // Replace 'tag' with the actual taxonomy name

	if ($terms && !is_wp_error($terms)) {
		$post_terms = '';
		foreach ($terms as $term) {
			// Access term properties like $term->term_id, $term->name, $term->slug, etc.
			$term_link = get_term_link($term);
			if (!is_wp_error($term_link)) {
				$post_terms .= '<a href="' . esc_url($term_link) . '">' . $term->name . '</a>, ';
			}
		}
	}
	return $post_terms;
}




/*
==========================================================================================================================================
In WordPress, there are several global variables that you can access using the global keyword to obtain information about various aspects of the current page or request. Here is a list of some commonly used global objects and variables:

global $post: Represents the current post or page being displayed. You can access properties and data related to the post or page.
global $wp_query: Represents the main WordPress query object. It holds information about the current query and can be used to retrieve posts and their details.
global $wpdb: The WordPress database object. You can use it to interact directly with the WordPress database and execute custom database queries.
global $current_user: Represents the current user. It's an instance of the WP_User class and provides information about the currently logged-in user.
global $wp: An instance of the WP class, representing the WordPress environment. It provides access to various WordPress functions and settings.
global $woocommerce: An instance of the WC() function, representing the WooCommerce environment. It provides access to various WooCommerce functions and settings.
global $wp_customize: Represents the Customizer environment and is used for live previewing theme changes.
global $comment: Represents the current comment being processed when viewing a single comment.
global $wp_registered_sidebars: An array containing information about registered sidebars and widget areas.
global $wp_registered_widgets: An array containing information about registered widgets.
global $wp_scripts and $wp_styles: Represent the registered scripts and styles for the current WordPress page.
global $pagenow: Contains the name of the current WordPress administration page (e.g., 'post.php', 'admin.php', 'edit.php', etc.).


==========================================================================================================================================
In WooCommerce, you can access various global objects and variables to work with WooCommerce-related data and functionality. Here's a list of some commonly used global objects and variables in WooCommerce, which you can access using the global keyword:

global $product: Represents the current product being displayed on a product page. You can access properties and data related to the product.
global $woocommerce: An instance of the WC() function, representing the WooCommerce environment. It provides access to various WooCommerce functions and settings.
global $cart: Represents the WooCommerce shopping cart. You can interact with the cart to add, remove, or manipulate items.
global $order: Represents the current order being viewed or processed, typically on the order confirmation page or in the admin area.
global $customer: Represents the current customer/user in WooCommerce. It's an instance of the WC_Customer class.
global $wc_currency_switcher: An instance of the WooCommerce Currency Switcher class. It allows you to switch between different currencies in a multi-currency setup.
global $wc_customer_bought_product: An instance of the WC_Customer_Bought_Product class, used to check if a customer has previously purchased a specific product.
global $wc_memberships: An instance of the WooCommerce Memberships class, used to manage membership-related functionality.
global $wc_membership_plan: Represents the currently selected membership plan, typically used within the loop when displaying membership details.
global $wc_memberships_user: Represents the current user's membership status and information.
global $wc_subscription: Represents the current subscription being viewed or processed, typically on subscription-related pages.
global $wc_product_vendors: An instance of the WooCommerce Product Vendors class, used for managing vendor-related functionality in a multi-vendor marketplace.
These global objects and variables allow you to access and manipulate various aspects of WooCommerce, such as products, orders, customers, and memberships, to customize and extend your WooCommerce-powered online store.
==========================================================================================================================================
*/