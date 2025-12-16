<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'laravel', 'php', 'javascript', 'web-development', 'css', 'html', 
            'frontend', 'backend', 'database', 'api', 'mobile', 'ui', 'ux',
            'artificial-intelligence', 'machine-learning', 'python', 'react',
            'vue', 'angular', 'nodejs', 'express', 'mongodb', 'mysql', 'postgresql',
            'cloud-computing', 'devops', 'docker', 'kubernetes', 'laravel-eloquent',
            'laravel-blade', 'laravel-auth', 'laravel-routing', 'laravel-middleware',
            'laravel-queues', 'laravel-cache', 'laravel-events', 'laravel-jobs',
            'testing', 'tdd', 'phpunit', 'jest', 'laravel-testing', 'security',
            'performance', 'optimization', 'laravel-packages', 'laravel-tips',
            'laravel-news', 'code-quality', 'refactoring', 'laravel-8', 'laravel-9',
            'laravel-10', 'tailwind', 'bootstrap', 'responsive-design', 'laravel-api',
            'laravel-passport', 'laravel-sanctum', 'laravel-breeze', 'laravel-fortify',
            'laravel-ui', 'laravel-mix', 'vite', 'laravel-horizon', 'laravel-scout',
            'laravel-telescope', 'laravel-nova', 'laravel-actions', 'laravel-models',
            'laravel-controllers', 'laravel-requests', 'laravel-resources', 'laravel-routes',
            'laravel-middleware', 'laravel-events', 'laravel-jobs', 'laravel-listeners',
            'laravel-observers', 'laravel-policies', 'laravel-authorization',
            'laravel-validation', 'laravel-collections', 'laravel-helpers',
            'laravel-mail', 'laravel-notifications', 'laravel-broadcasting',
            'laravel-queues', 'laravel-caching', 'laravel-sessions',
            'laravel-filesystem', 'laravel-encryption', 'laravel-hashing',
            'laravel-localization', 'laravel-logging', 'laravel-configuration',
            'laravel-artisan', 'laravel-tinker', 'laravel-ide-helper',
            'laravel-debug', 'laravel-profiling', 'laravel-architecture',
            'laravel-best-practices', 'laravel-security', 'laravel-performance',
            'laravel-optimization', 'laravel-deployment', 'laravel-server',
            'laravel-nginx', 'laravel-apache', 'laravel-database',
            'laravel-relationships', 'laravel-migrations', 'laravel-seeds',
            'laravel-factories', 'laravel-faker', 'laravel-models', 'laravel-orm',
            'laravel-eager-loading', 'laravel-query-builder', 'laravel-scope',
            'laravel-accessor', 'laravel-mutator', 'laravel-composer',
            'laravel-package', 'laravel-ecosystem', 'laravel-community',
            'laravel-upgrade', 'laravel-compatibility', 'laravel-maintenance',
            'laravel-updates', 'laravel-features', 'laravel-improvements',
            'laravel-changes', 'laravel-releases', 'laravel-release-notes',
            'laravel-documentation', 'laravel-tutorials', 'laravel-resources',
            'laravel-examples', 'laravel-projects', 'laravel-applications',
            'laravel-websites', 'laravel-ecommerce', 'laravel-blogging',
            'laravel-cms', 'laravel-portfolio', 'laravel-dashboard',
            'laravel-admin', 'laravel-api', 'laravel-rest-api', 'laravel-graphql',
            'laravel-graphql-api', 'laravel-jwt', 'laravel-roles', 'laravel-permissions',
            'laravel-authorization', 'laravel-policies', 'laravel-gates',
            'laravel-passport', 'laravel-oauth', 'laravel-socialite',
            'laravel-activity-log', 'laravel-auditing', 'laravel-impersonation',
            'laravel-multi-tenant', 'laravel-multi-database', 'laravel-eloquent-relationships',
            'laravel-eloquent-mutators', 'laravel-eloquent-accessors', 'laravel-eloquent-casts',
            'laravel-eloquent-scopes', 'laravel-eloquent-global-scopes',
            'laravel-eloquent-local-scopes', 'laravel-eloquent-events',
            'laravel-eloquent-observers', 'laravel-eloquent-soft-deletes',
            'laravel-eloquent-timestamps', 'laravel-eloquent-uuids',
            'laravel-eloquent-encryption', 'laravel-eloquent-serialization',
            'laravel-eloquent-comparison', 'laravel-eloquent-relation-queries',
            'laravel-eloquent-polymorphic', 'laravel-eloquent-many-to-many',
            'laravel-eloquent-one-to-many', 'laravel-eloquent-one-to-one',
            'laravel-eloquent-has-many', 'laravel-eloquent-belongs-to',
            'laravel-eloquent-has-one', 'laravel-eloquent-morph-many',
            'laravel-eloquent-morph-to', 'laravel-eloquent-morph-one',
            'laravel-eloquent-pivot', 'laravel-eloquent-custom-pivot',
            'laravel-eloquent-join', 'laravel-eloquent-where', 'laravel-eloquent-order',
            'laravel-eloquent-limit', 'laravel-eloquent-offset', 'laravel-eloquent-aggregate',
            'laravel-eloquent-count', 'laravel-eloquent-sum', 'laravel-eloquent-max',
            'laravel-eloquent-min', 'laravel-eloquent-avg', 'laravel-eloquent-pluck',
            'laravel-eloquent-get', 'laravel-eloquent-first', 'laravel-eloquent-find',
            'laravel-eloquent-findOrFail', 'laravel-eloquent-exists', 'laravel-eloquent-doesntExist',
            'laravel-eloquent-when', 'laravel-eloquent-unless', 'laravel-eloquent-whereHas',
            'laravel-eloquent-with', 'laravel-eloquent-load', 'laravel-eloquent-lazy-eager-loading',
            'laravel-eloquent-constraints', 'laravel-eloquent-joins', 'laravel-eloquent-aggregate-queries',
            'laravel-eloquent-raw-queries', 'laravel-eloquent-raw-expressions',
            'laravel-eloquent-raw-statements', 'laravel-eloquent-raw-selects',
            'laravel-eloquent-raw-wheres', 'laravel-eloquent-raw-order-bys',
            'laravel-eloquent-raw-group-bys', 'laravel-eloquent-raw-havings',
            'laravel-eloquent-raw-limits', 'laravel-eloquent-raw-offsets',
            'laravel-eloquent-raw-unions', 'laravel-eloquent-raw-joins',
            'laravel-eloquent-raw-left-joins', 'laravel-eloquent-raw-right-joins',
            'laravel-eloquent-raw-cross-joins', 'laravel-eloquent-raw-inner-joins',
            'laravel-eloquent-raw-outer-joins', 'laravel-eloquent-raw-natural-joins',
            'laravel-eloquent-raw-self-joins', 'laravel-eloquent-raw-straight-joins',
            'laravel-eloquent-raw-force-index', 'laravel-eloquent-raw-use-index',
            'laravel-eloquent-raw-ignore-index', 'laravel-eloquent-raw-hint-index',
            'laravel-eloquent-raw-hint-table', 'laravel-eloquent-raw-hint-database',
            'laravel-eloquent-raw-hint-query', 'laravel-eloquent-raw-hint-optimizer',
            'laravel-eloquent-raw-hint-join', 'laravel-eloquent-raw-hint-group',
            'laravel-eloquent-raw-hint-order', 'laravel-eloquent-raw-hint-select',
            'laravel-eloquent-raw-hint-from', 'laravel-eloquent-raw-hint-where',
            'laravel-eloquent-raw-hint-join-condition', 'laravel-eloquent-raw-hint-on',
            'laravel-eloquent-raw-hint-using', 'laravel-eloquent-raw-hint-using-column',
            'laravel-eloquent-raw-hint-comparison', 'laravel-eloquent-raw-hint-operator',
            'laravel-eloquent-raw-hint-logical', 'laravel-eloquent-raw-hint-boolean'
        ];

        foreach (array_unique($tags) as $tagName) {
            Tag::firstOrCreate([
                'name' => $tagName,
                'slug' => \Illuminate\Support\Str::slug($tagName),
            ]);
        }
    }
}