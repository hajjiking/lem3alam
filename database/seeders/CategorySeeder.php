<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing categories
        Category::query()->delete();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            // 1. Home Repairs & Maintenance
            [
                'name' => 'Home Repairs & Maintenance',
                'name_translations' => [
                    'fr' => 'Réparations et Entretien de Maison',
                    'ar' => 'إصلاحات وصيانة المنزل',
                ],
                'description' => 'Professional home repair and maintenance services',
                'description_translations' => [
                    'fr' => 'Services professionnels de réparation et d\'entretien de maison',
                    'ar' => 'خدمات إصلاح وصيانة المنزل المهنية',
                ],
                'icon' => 'tools',
                'color' => '#3B82F6',
                'is_active' => true,
                'sort_order' => 1,
                'subcategories' => [
                    'Minor Home Repairs' => ['fr' => 'Petites Réparations', 'ar' => 'إصلاحات منزلية بسيطة'],
                    'Furniture Assembly' => ['fr' => 'Assemblage de Meubles', 'ar' => 'تجميع الأثاث'],
                    'Mounting (TVs, shelves, art, curtains, etc.)' => ['fr' => 'Montage (TV, étagères, art, rideaux, etc.)', 'ar' => 'تركيب (التلفزيونات، الرفوف، اللوحات، الستائر، إلخ)'],
                    'Plumbing Help' => ['fr' => 'Aide en Plomberie', 'ar' => 'مساعدة السباكة'],
                    'Electrical Help' => ['fr' => 'Aide Électrique', 'ar' => 'مساعدة كهربائية'],
                    'Painting' => ['fr' => 'Peinture', 'ar' => 'الطلاء'],
                    'Carpentry' => ['fr' => 'Menuiserie', 'ar' => 'النجارة'],
                    'Smart Home Installation' => ['fr' => 'Installation Maison Intelligente', 'ar' => 'تركيب المنزل الذكي'],
                ],
            ],
            // 2. Cleaning & Housekeeping
            [
                'name' => 'Cleaning & Housekeeping',
                'name_translations' => [
                    'fr' => 'Nettoyage et Entretien Ménager',
                    'ar' => 'التنظيف والتدبير المنزلي',
                ],
                'description' => 'Professional cleaning and housekeeping services',
                'description_translations' => [
                    'fr' => 'Services professionnels de nettoyage et d\'entretien ménager',
                    'ar' => 'خدمات التنظيف والتدبير المنزلي المهنية',
                ],
                'icon' => 'broom',
                'color' => '#10B981',
                'is_active' => true,
                'sort_order' => 2,
                'subcategories' => [
                    'Home Cleaning' => ['fr' => 'Nettoyage de Maison', 'ar' => 'تنظيف المنزل'],
                    'Deep Cleaning' => ['fr' => 'Nettoyage en Profondeur', 'ar' => 'التنظيف العميق'],
                    'Move-Out Cleaning' => ['fr' => 'Nettoyage de Déménagement', 'ar' => 'تنظيف ما بعد الانتقال'],
                    'Laundry Help' => ['fr' => 'Aide à la Lessive', 'ar' => 'مساعدة الغسيل'],
                    'Organization' => ['fr' => 'Organisation', 'ar' => 'التنظيم'],
                    'Disinfecting Services' => ['fr' => 'Services de Désinfection', 'ar' => 'خدمات التطهير'],
                ],
            ],
            // 3. Moving & Heavy Lifting
            [
                'name' => 'Moving & Heavy Lifting',
                'name_translations' => [
                    'fr' => 'Déménagement et Levage Lourd',
                    'ar' => 'النقل والرفع الثقيل',
                ],
                'description' => 'Moving, lifting and transportation services',
                'description_translations' => [
                    'fr' => 'Services de déménagement, levage et transport',
                    'ar' => 'خدمات النقل والرفع والمواصلات',
                ],
                'icon' => 'truck',
                'color' => '#F59E0B',
                'is_active' => true,
                'sort_order' => 3,
                'subcategories' => [
                    'Help Moving' => ['fr' => 'Aide au Déménagement', 'ar' => 'مساعدة النقل'],
                    'Heavy Lifting' => ['fr' => 'Levage Lourd', 'ar' => 'الرفع الثقيل'],
                    'Furniture Rearrangement' => ['fr' => 'Réaménagement de Meubles', 'ar' => 'إعادة ترتيب الأثاث'],
                    'Packing & Unpacking' => ['fr' => 'Emballage et Déballage', 'ar' => 'التعبئة والتفريغ'],
                    'Junk Removal' => ['fr' => 'Enlèvement d\'Objets Encombrants', 'ar' => 'إزالة الخردة'],
                    'Garage / Attic / Basement Help' => ['fr' => 'Aide Garage / Grenier / Sous-sol', 'ar' => 'مساعدة الجراج / العلية / القبو'],
                ],
            ],
            // 4. Yardwork & Outdoor Tasks
            [
                'name' => 'Yardwork & Outdoor Tasks',
                'name_translations' => [
                    'fr' => 'Travaux de Jardin et Tâches Extérieures',
                    'ar' => 'أعمال الحديقة والمهام الخارجية',
                ],
                'description' => 'Outdoor maintenance and landscaping services',
                'description_translations' => [
                    'fr' => 'Services d\'entretien extérieur et d\'aménagement paysager',
                    'ar' => 'خدمات الصيانة الخارجية وتنسيق الحدائق',
                ],
                'icon' => 'leaf',
                'color' => '#22C55E',
                'is_active' => true,
                'sort_order' => 4,
                'subcategories' => [
                    'Yard Work' => ['fr' => 'Travaux de Jardin', 'ar' => 'أعمال الحديقة'],
                    'Gardening' => ['fr' => 'Jardinage', 'ar' => 'البستنة'],
                    'Snow Removal' => ['fr' => 'Déneigement', 'ar' => 'إزالة الثلج'],
                    'Leaf Raking' => ['fr' => 'Ramassage de Feuilles', 'ar' => 'جمع الأوراق'],
                    'Pressure Washing' => ['fr' => 'Nettoyage Haute Pression', 'ar' => 'الغسيل بالضغط العالي'],
                    'Lawn Mowing' => ['fr' => 'Tonte de Pelouse', 'ar' => 'جز العشب'],
                ],
            ],
            // 5. Errands & Shopping
            [
                'name' => 'Errands & Shopping',
                'name_translations' => [
                    'fr' => 'Courses et Shopping',
                    'ar' => 'المهام والتسوق',
                ],
                'description' => 'Personal errands and shopping assistance',
                'description_translations' => [
                    'fr' => 'Assistance pour les courses personnelles et le shopping',
                    'ar' => 'مساعدة المهام الشخصية والتسوق',
                ],
                'icon' => 'shopping-cart',
                'color' => '#8B5CF6',
                'is_active' => true,
                'sort_order' => 5,
                'subcategories' => [
                    'Grocery Shopping' => ['fr' => 'Courses Alimentaires', 'ar' => 'تسوق البقالة'],
                    'Running Errands' => ['fr' => 'Faire des Courses', 'ar' => 'تنفيذ المهام'],
                    'Delivery Services' => ['fr' => 'Services de Livraison', 'ar' => 'خدمات التوصيل'],
                    'Contactless Delivery' => ['fr' => 'Livraison Sans Contact', 'ar' => 'التوصيل بدون تلامس'],
                ],
            ],
            // 6. Personal & Office Help
            [
                'name' => 'Personal & Office Help',
                'name_translations' => [
                    'fr' => 'Aide Personnelle et de Bureau',
                    'ar' => 'المساعدة الشخصية والمكتبية',
                ],
                'description' => 'Personal assistance and office support services',
                'description_translations' => [
                    'fr' => 'Services d\'assistance personnelle et de support de bureau',
                    'ar' => 'خدمات المساعدة الشخصية ودعم المكتب',
                ],
                'icon' => 'briefcase',
                'color' => '#EF4444',
                'is_active' => true,
                'sort_order' => 6,
                'subcategories' => [
                    'Personal Assistant' => ['fr' => 'Assistant Personnel', 'ar' => 'مساعد شخصي'],
                    'Office Help' => ['fr' => 'Aide de Bureau', 'ar' => 'مساعدة مكتبية'],
                    'Data Entry' => ['fr' => 'Saisie de Données', 'ar' => 'إدخال البيانات'],
                    'Research' => ['fr' => 'Recherche', 'ar' => 'البحث'],
                    'Event Help' => ['fr' => 'Aide pour Événements', 'ar' => 'مساعدة الفعاليات'],
                ],
            ],
            // 7. Care & Special Help
            [
                'name' => 'Care & Special Help',
                'name_translations' => [
                    'fr' => 'Soins et Aide Spécialisée',
                    'ar' => 'الرعاية والمساعدة الخاصة',
                ],
                'description' => 'Specialized care and assistance services',
                'description_translations' => [
                    'fr' => 'Services de soins et d\'assistance spécialisés',
                    'ar' => 'خدمات الرعاية والمساعدة المتخصصة',
                ],
                'icon' => 'heart',
                'color' => '#EC4899',
                'is_active' => true,
                'sort_order' => 7,
                'subcategories' => [
                    'Pet Sitting & Dog Walking' => ['fr' => 'Garde d\'Animaux et Promenade de Chiens', 'ar' => 'رعاية الحيوانات الأليفة ومشي الكلاب'],
                    'Childcare Assistance (non-medical)' => ['fr' => 'Assistance Garde d\'Enfants (non-médical)', 'ar' => 'مساعدة رعاية الأطفال (غير طبية)'],
                    'Elderly Companion (non-medical)' => ['fr' => 'Compagnon pour Personnes Âgées (non-médical)', 'ar' => 'مرافق كبار السن (غير طبي)'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $subcategories = $categoryData['subcategories'] ?? [];
            unset($categoryData['subcategories']);

            $category = Category::create($categoryData);

            // Create subcategories
            $sortOrder = 1;
            foreach ($subcategories as $subName => $translations) {
                Category::create([
                    'name' => $subName,
                    'name_translations' => $translations,
                    'description' => $subName,
                    'description_translations' => $translations,
                    'parent_id' => $category->id,
                    'is_active' => true,
                    'sort_order' => $sortOrder++,
                ]);
            }
        }
    }
}
