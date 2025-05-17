<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tables = [
            'persons',
            'organizations',
            'profiles',
            'customers',
            'products',
            'master_products',
            'master_product_variants',
            'product_images',
            'carts',
            'cart_items',
            'orders',
            'order_items',
            'billpayers',
            'shipments',
            'shippables',
            'channels',
            'payment_methods',
            'payments',
            'payment_history',
            'adjustments',
            'tax_categories',
            'tax_rates',
            'taxonomies',
            'taxons',
            'model_taxons',
            'properties',
            'property_values',
            'model_property_values',
            'languages',
            'zones',
            'shipping_methods',
            'carriers',
            'link_types',
            'link_groups',
            'link_group_items',
            'channelables',
            'promotions',
            'coupons',
            'promotion_rules',
            'promotion_actions',
            'customer_purchases',
            'invitations',
            'users',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedInteger('created_by')->default(0)->after('created_at');
                $table->unsignedInteger('updated_by')->nullable()->after('updated_at');
                $table->unsignedInteger('deleted_by')->nullable()->after('updated_by');
            });
        }
    }

    public function down()
    {
        $tables = [
            'persons',
            'organizations',
            'profiles',
            'customers',
            'products',
            'master_products',
            'master_product_variants',
            'product_images',
            'carts',
            'cart_items',
            'orders',
            'order_items',
            'billpayers',
            'shipments',
            'shippables',
            'channels',
            'payment_methods',
            'payments',
            'payment_history',
            'adjustments',
            'tax_categories',
            'tax_rates',
            'taxonomies',
            'taxons',
            'model_taxons',
            'properties',
            'property_values',
            'model_property_values',
            'languages',
            'zones',
            'shipping_methods',
            'carriers',
            'link_types',
            'link_groups',
            'link_group_items',
            'channelables',
            'promotions',
            'coupons',
            'promotion_rules',
            'promotion_actions',
            'customer_purchases',
            'invitations',
            'users',

        ];
        

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
            });
        }
    }
};
