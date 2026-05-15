<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | STEP 1
        | Rename / remove existing columns first
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {

            $table->renameColumn('name', 'first_name');

            $table->dropColumn('phone');

        });

        /*
        |--------------------------------------------------------------------------
        | STEP 2
        | Add new columns
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            $table->string('last_name')
                ->nullable()
                ->after('first_name');

            /*
            |--------------------------------------------------------------------------
            | User Classification
            |--------------------------------------------------------------------------
            */

            $table->enum('user_type', ['internal', 'external'])
                ->default('external')
                ->after('password');

            $table->enum('role', [
                'administrator',
                'manager',
                'member'
            ])
                ->default('member')
                ->after('user_type');

            $table->string('employee_id')
                ->nullable()
                ->after('role');

            /*
            |--------------------------------------------------------------------------
            | Company Information
            |--------------------------------------------------------------------------
            */

            $table->string('company_name')
                ->nullable()
                ->after('employee_id');

            $table->string('company_registration_number')
                ->nullable()
                ->after('company_name');

            $table->string('vat_number')
                ->nullable()
                ->after('company_registration_number');

            /*
            |--------------------------------------------------------------------------
            | Personal Address
            |--------------------------------------------------------------------------
            */

            $table->string('personal_address')
                ->nullable()
                ->after('vat_number');

            $table->string('personal_postal_code')
                ->nullable()
                ->after('personal_address');

            $table->string('personal_city')
                ->nullable()
                ->after('personal_postal_code');

            $table->string('personal_country')
                ->nullable()
                ->after('personal_city');

            /*
            |--------------------------------------------------------------------------
            | Business Address
            |--------------------------------------------------------------------------
            */

            $table->string('business_address')
                ->nullable()
                ->after('personal_country');

            $table->string('business_postal_code')
                ->nullable()
                ->after('business_address');

            $table->string('business_city')
                ->nullable()
                ->after('business_postal_code');

            $table->string('business_country')
                ->nullable()
                ->after('business_city');

            /*
            |--------------------------------------------------------------------------
            | Banking Information
            |--------------------------------------------------------------------------
            */

            $table->string('bank_name')
                ->nullable()
                ->after('business_country');

            $table->string('bank_account_holder')
                ->nullable()
                ->after('bank_name');

            $table->string('iban')
                ->nullable()
                ->after('bank_account_holder');

            /*
            |--------------------------------------------------------------------------
            | Phone Information
            |--------------------------------------------------------------------------
            */

            $table->string('phone_country_code')
                ->nullable()
                ->after('iban');

            $table->string('phone_number')
                ->nullable()
                ->after('phone_country_code');

            /*
            |--------------------------------------------------------------------------
            | Profile Information
            |--------------------------------------------------------------------------
            */

            $table->text('about')
                ->nullable()
                ->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([

                // Personal
                'last_name',

                // User classification
                'user_type',
                'role',
                'employee_id',

                // Company
                'company_name',
                'company_registration_number',
                'vat_number',

                // Personal address
                'personal_address',
                'personal_postal_code',
                'personal_city',
                'personal_country',

                // Business address
                'business_address',
                'business_postal_code',
                'business_city',
                'business_country',

                // Banking
                'bank_name',
                'bank_account_holder',
                'iban',

                // Phone
                'phone_country_code',
                'phone_number',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Restore Old Columns
            |--------------------------------------------------------------------------
            */

            $table->renameColumn('first_name', 'name');

            $table->string('phone')
                ->nullable();

            $table->string('about')
                ->nullable()
                ->change();

        });
    }
};