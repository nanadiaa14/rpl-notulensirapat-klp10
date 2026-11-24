<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->foreignId('notulis_id')
                ->nullable()
                ->after('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            // tanggal diisi nanti, saat audio direkam atau diunggah
            $table->dateTime('meeting_date')->nullable()->change();
        });

        Schema::table('transcripts', function (Blueprint $table) {
            $table->unique('meeting_id');
        });

        Schema::table('meeting_notes', function (Blueprint $table) {
            $table->unique('meeting_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('nip');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nip']);
        });

        foreach (['meeting_notes', 'transcripts'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['meeting_id']);
                $table->dropUnique(['meeting_id']);
                $table->foreign('meeting_id')->references('id')->on('meetings')->cascadeOnDelete();
            });
        }

        Schema::table('meetings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('notulis_id');
            $table->dateTime('meeting_date')->nullable(false)->change();
        });
    }
};