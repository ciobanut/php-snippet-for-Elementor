
This snippet helps you to insert wordpress variables into pages or posts created with Elementor free.

  

To use this snippet you must have a WordPress website with [Elementor free](https://wordpress.org/plugins/elementor/) version.

I also recommend using the [Code Snippets plugin](https://wordpress.org/plugins/code-snippets/). But you can also place the code in the functions.php file.

  

# How to use

  

Just copy the code of the snippet.php file and paste it in the functions.php file or in Code Snippets on your website. Save and activate it for front-end.

  

Create a new page or article with Elementor. Add any widget in which you can add text: header, text editor, button,... and paste any placeholder you need. For example: `{{ post_title }}`. Save and see the result.

  

Copy the text from the example.txt file and paste it into your Elementor page to see how each element works.


**WooCommerce**


If you want to use woocommerce placeholders you need to uncomment the corresponding placeholders.

  

## Placeholders list

  

`{{ post_id }}`

`{{ post_title }}`

`{{ post_content }}`

`{{ post_excerpt }}`

`{{ post_date }}`

`{{ post_date_gmt }}`

`{{ post_author }}`

`{{ post_status }}`

`{{ post_type }}`

`{{ post_name }}`

`{{ post_parent }}`

`{{ post_modified }}`

`{{ post_modified_gmt }}`

`{{ post_content_filtered }}`

`{{ post_mime_type }}`

`{{ comment_count }}`

  

`{{ custom_field_value }}`

  

`{{ tags }}`

`{{ tags_with_link }}`

  

`{{ categories }}`

`{{ categories_with_link }}`

  

`{{ user_ID }}`

`{{ user_login }}`

`{{ user_email }}`

`{{ user_nicename }}`

`{{ display_name }}`

`{{ user_registered }}`

`{{ user_url }}`

`{{ user_status }}`

`{{ user_roles }}`

`{{ user_firstname }}`

`{{ user_lastname }}`

`{{ user_description }}`

  

**WooCommerce product**

`{{ product_id }}`

`{{ product_name }}`

`{{ product_sku }}`

`{{ product_price }}`

`{{ product_regular_price }}`

`{{ product_sale_price }}`

`{{ product_stock_quantity }}`

`{{ product_permalink }}`

`{{ product_short_description }}`

`{{ product_description }}`

  

**WooCommerce order**

`{{ order_id }}`

`{{ order_number }}`

`{{ order_status }}`

`{{ billing_address }}`

`{{ shipping_address }}`

`{{ billing_email }}`

`{{ billing_phone }}`

`{{ payment_method }}`

`{{ payment_method_title }}`

  

**WooCommerce customer**

`{{ customer_id }}`

`{{ user_id }}`

`{{ billing_address }}`

`{{ shipping_address }}`

`{{ customer_email }}`

`{{ customer_first_name }}`

`{{ customer_last_name }}`

`{{ customer_username }}`