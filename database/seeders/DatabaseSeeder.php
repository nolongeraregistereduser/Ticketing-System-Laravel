<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categories;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data.
     */
    public function run(): void
    {
        // Create Demo Users
        // ==================
        
        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@demo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Agent Users
        $agent1 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'agent@demo.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'email_verified_at' => now(),
        ]);

        $agent2 = User::create([
            'name' => 'Mike Chen',
            'email' => 'agent2@demo.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'email_verified_at' => now(),
        ]);

        // Regular Users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'user@demo.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Emily Wilson',
            'email' => 'emily@demo.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $user3 = User::create([
            'name' => 'Robert Brown',
            'email' => 'robert@demo.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create Categories
        // =================
        $categories = [
            [
                'name' => 'Technical Support',
                'description' => 'Issues related to software bugs, errors, and technical problems',
            ],
            [
                'name' => 'Billing & Payments',
                'description' => 'Questions about invoices, payments, refunds, and subscriptions',
            ],
            [
                'name' => 'Account Issues',
                'description' => 'Problems with account access, password resets, and profile settings',
            ],
            [
                'name' => 'Feature Requests',
                'description' => 'Suggestions for new features and improvements',
            ],
            [
                'name' => 'General Inquiry',
                'description' => 'General questions and information requests',
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $category) {
            $createdCategories[] = Categories::create($category);
        }

        // Create Sample Tickets
        // =====================
        $tickets = [
            // Open tickets
            [
                'user_id' => $user1->id,
                'category_id' => $createdCategories[0]->id, // Technical Support
                'title' => 'Application crashes on login',
                'description' => 'When I try to log in to the application, it crashes immediately after entering my credentials. I have tried clearing cache and reinstalling but the issue persists. My browser is Chrome version 120.',
                'status' => 'open',
                'assigned_to' => null,
            ],
            [
                'user_id' => $user2->id,
                'category_id' => $createdCategories[1]->id, // Billing
                'title' => 'Incorrect charge on my account',
                'description' => 'I was charged $99 instead of $49 for my monthly subscription. Please review and refund the difference. Transaction ID: TXN-2024-001234.',
                'status' => 'open',
                'assigned_to' => null,
            ],
            [
                'user_id' => $user3->id,
                'category_id' => $createdCategories[2]->id, // Account Issues
                'title' => 'Cannot reset my password',
                'description' => 'I requested a password reset email but haven\'t received it. I\'ve checked spam folder and tried multiple times. My registered email is robert@demo.com.',
                'status' => 'open',
                'assigned_to' => null,
            ],
            
            // In Progress tickets
            [
                'user_id' => $user1->id,
                'category_id' => $createdCategories[0]->id, // Technical Support
                'title' => 'Slow page loading times',
                'description' => 'The dashboard takes over 10 seconds to load. This started happening after the last update. Network connection is stable.',
                'status' => 'in_progress',
                'assigned_to' => $agent1->id,
            ],
            [
                'user_id' => $user2->id,
                'category_id' => $createdCategories[3]->id, // Feature Requests
                'title' => 'Add dark mode option',
                'description' => 'It would be great to have a dark mode option for the interface. This would help reduce eye strain during night usage.',
                'status' => 'in_progress',
                'assigned_to' => $agent2->id,
            ],
            [
                'user_id' => $user3->id,
                'category_id' => $createdCategories[4]->id, // General Inquiry
                'title' => 'API documentation request',
                'description' => 'Is there any API documentation available? We want to integrate your service with our internal tools.',
                'status' => 'in_progress',
                'assigned_to' => $agent1->id,
            ],
            
            // Closed tickets
            [
                'user_id' => $user1->id,
                'category_id' => $createdCategories[1]->id, // Billing
                'title' => 'Subscription upgrade question',
                'description' => 'How do I upgrade from the basic to premium plan? What additional features will I get?',
                'status' => 'closed',
                'assigned_to' => $agent1->id,
            ],
            [
                'user_id' => $user2->id,
                'category_id' => $createdCategories[2]->id, // Account Issues
                'title' => 'Update billing address',
                'description' => 'I need to update my billing address to: 123 New Street, City, Country 12345.',
                'status' => 'closed',
                'assigned_to' => $agent2->id,
            ],
            [
                'user_id' => $user3->id,
                'category_id' => $createdCategories[0]->id, // Technical Support
                'title' => 'File upload not working',
                'description' => 'When trying to upload files larger than 5MB, I get an error message. Is there a file size limit?',
                'status' => 'closed',
                'assigned_to' => $agent1->id,
            ],
            [
                'user_id' => $user1->id,
                'category_id' => $createdCategories[4]->id, // General Inquiry
                'title' => 'Business hours inquiry',
                'description' => 'What are your customer support business hours? Do you offer weekend support?',
                'status' => 'closed',
                'assigned_to' => $agent2->id,
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }

        // Output summary for demo
        $this->command->info('');
        $this->command->info('🎉 Demo data seeded successfully!');
        $this->command->info('');
        $this->command->info('📧 Demo Login Credentials (password for all: "password"):');
        $this->command->info('   ┌──────────────────────────────────────────────┐');
        $this->command->info('   │  👑 Admin:  admin@demo.com                   │');
        $this->command->info('   │  🎧 Agent:  agent@demo.com                   │');
        $this->command->info('   │  👤 User:   user@demo.com                    │');
        $this->command->info('   └──────────────────────────────────────────────┘');
        $this->command->info('');
        $this->command->info('📊 Created: 6 Users, 5 Categories, 10 Tickets');
        $this->command->info('');
    }
}
