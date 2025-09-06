use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('restaurant_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('location');
            $table->string('image_path')->nullable();      // uploaded image (optional)
            $table->string('description', 800)->nullable();
            $table->text('food_menu')->nullable();
            $table->text('service_review')->nullable();

            $table->string('status', 20)->default('pending'); // 'pending' only; we delete on reject/approve
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_requests');
    }
};
