<?php

namespace Database\Seeders;

use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolLessonBlock;
use App\Models\PepsolLessonParts;
use App\Models\PepsolName;
use App\Models\PepsolTopic;
use App\Models\PepsolType;
use App\Models\User;
use Illuminate\Database\Seeder;

class PepsolDiscipleshipSeeder extends Seeder
{
    public function run(): void
    {
        $category = PepsolCategory::where('code', 'DP-1')->first();
        $type = PepsolType::where('code', 'SOL 1-A')->first();
        $pepsolName = PepsolName::where('code', 'D-1')->first();
        $user = User::first();

        $pepsol = Pepsol::create([
            'pepsol_category_id' => $category->id,
            'pepsol_type_id' => $type->id,
            'created_by' => $user->id,
            'description' => 'DISCIPLESHIP - Equipping believers to become fully devoted followers of Christ who make disciples.',
            'guidelines' => 'Study each lesson prayerfully and apply the principles of discipleship in your daily life.',
            'orientation' => 'These lessons are designed to help born-again Christians grow in their faith and become disciple-makers.',
            'status' => 'published',
        ]);

        $this->createLesson1($pepsol, $pepsolName);
        $this->createLesson2($pepsol, $pepsolName);
        $this->createLesson3($pepsol, $pepsolName);
        $this->createLesson4($pepsol, $pepsolName);
        $this->createLesson5($pepsol, $pepsolName);
        $this->createLesson6($pepsol, $pepsolName);
        $this->createLesson7($pepsol, $pepsolName);
        $this->createLesson8($pepsol, $pepsolName);
        $this->createLesson9($pepsol, $pepsolName);
        $this->createLesson10($pepsol, $pepsolName);
    }

    private function getTopic($lessonNumber)
    {
        return PepsolTopic::where('name', 'Lesson ' . $lessonNumber)->first();
    }

    private function createLesson1($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(1);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Tunay na Disipulo',
            'subtitle' => 'The True Disciple',
            'summary' => 'Ang tunay na disipulo ay isang taong lubos na sumusunod kay Hesus, handang magbayad ng halaga, at nagbubunga ng mga alagad.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG TUNAY NA DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sinabi ni Jesus sa kanyang mga alagad, \'Kung nais ng sinuman na sumunod sa akin, kinakailangang itakwil niya ang kanyang sarili, pasanin ang kanyang krus, at sumunod sa akin.\'"',
            'reference' => 'Mateo 16:24',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging disipulo ni Hesus ay higit pa sa pagiging isang mananampalataya lamang. Ito ay isang buong-pusong pagtatalaga na sumunod kay Kristo, maging katulad Niya, at gawin ang Kanyang ipinag-uutos.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang mga ipinanganak na muli, tayo ay tinawag hindi lamang upang maligtas kundi upang maging mga disipulo na gumagawa ng mga alagad. Ang disipulasyon ay ang proseso ng pagiging katulad ni Kristo.',
            'sort_order' => 4,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'KATANGIAN NG ISANG TUNAY NA DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. NAGTATAKWIL NG SARILI (DENIES HIMSELF)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagtatakwil sa sarili ay nangangahulugang hindi na ang sariling kagustuhan ang sentro ng buhay kundi ang kagustuhan ng Diyos. Ito ay ang pagpapasakop ng ating mga nais sa Kanyang kalooban.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PASANIN ANG KRUS (TAKES UP HIS CROSS)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagpapasan ng krus ay nangangahulugang handang magdusa at magsakripisyo para kay Kristo. Ito ay ang pagtanggap ng mga pagsubok at paghihirap na kaakibat ng pagiging disipulo.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. SUMUSUNOD KAY HESUS (FOLLOWS JESUS)',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsunod kay Hesus ay nangangahulugang pamumuhay ayon sa Kanyang mga turo at halimbawa. Ito ay ang paggawa ng mga bagay na Kanyang ginawa at pag-ibig sa mga taong Kanyang iniibig.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG HALAGA NG PAGIGING DISIPULO',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat ang sinumang nagnanais na magligtas ng kanyang buhay ay mawawalan nito; ngunit ang sinumang mawalan ng kanyang buhay dahil sa akin ay makakasumpong nito."',
            'reference' => 'Mateo 16:25',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging disipulo ay may malaking halaga. Ang magbigay ng ating buhay kay Kristo ay ang tunay na paraan upang matagpuan ang tunay na buhay at kabuluhan.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUNGA NG PAGIGING DISIPULO',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagbabago ng pagkatao - nagiging katulad ni Kristo',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pag-ibig sa kapwa - nagmamahal tulad ni Hesus',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paglilingkod - naglilingkod sa iba nang may pagpapakumbaba',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paggawa ng alagad - nagpaparami ng mga disipulo',
            'sort_order' => 15,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Ano ang mga bagay na kailangan mong itakwil upang lubos na makasunod kay Hesus?

2. Ano ang iyong "krus" na kailangan mong pasanin sa kasalukuyan?

3. Paano mo maipapakita ang iyong pagsunod kay Hesus sa iyong pang-araw-araw na buhay?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, tinatanggap ko ang Iyong tawag upang maging Iyong tunay na disipulo. Itakwil ko ang aking sariling kagustuhan at susundin Ko ang Iyong kalooban.

Tulungan Mo akong pasanin ang aking krus nang may kagalakan at pagtitiwala sa Iyo. Nawa ang aking buhay ay magbunga ng kaluwalhatian sa Iyong pangalan.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson2($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(2);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Salita ng Diyos sa Buhay ng Disipulo',
            'subtitle' => 'The Word of God in the Disciple\'s Life',
            'summary' => 'Ang Salita ng Diyos ang pundasyon ng buhay ng isang disipulo. Ito ang gabay, pagkain, at sandata sa espirituwal na paglalakbay.',
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG SALITA NG DIYOS SA BUHAY NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang buong Kasulatan ay kinasihan ng Diyos at kapaki-pakinabang sa pagtuturo, sa pagsaway, sa pagtutuwid, at sa pagsasanay sa katuwiran."',
            'reference' => '2 Timoteo 3:16',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Salita ng Diyos ang pinakamahalagang pundasyon ng buhay ng isang disipulo. Ito ang ating gabay, pagkain, at sandata sa ating espirituwal na paglalakbay.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PAPEL NG SALITA NG DIYOS SA BUHAY NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. GABAY SA BUHAY (GUIDE FOR LIFE)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang Salita mo ay ilawan sa aking mga paa at liwanag sa aking landas."',
            'reference' => 'Awit 119:105',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Bibliya ay nagbibigay ng direksyon sa ating buhay. Sa pamamagitan nito, nalalaman natin ang kalooban ng Diyos at kung paano tayo dapat mamuhay.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PAGKAIN NG ESPIRITU (SPIRITUAL FOOD)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung paanong ang mga sanggol ay nananabik sa gatas, gayon din kayo ay manabik sa dalisay na espirituwal na gatas upang kayo ay lumago."',
            'reference' => '1 Pedro 2:2',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung paanong kailangan ng katawan ang pagkain upang lumago, kailangan din ng espiritu ang Salita ng Diyos upang lumago at maging matatag.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. SANDATA SA LABANAN (WEAPON IN BATTLE)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"At ang tabak ng Espiritu, na siyang Salita ng Diyos."',
            'reference' => 'Efeso 6:17',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Salita ng Diyos ang ating pangunahing sandata laban sa mga atake ng kaaway. Sa pamamagitan nito, nagagawa nating lumaban at manatiling matatag.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO GAMITIN ANG SALITA NG DIYOS',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Basahin ito araw-araw - maglaan ng oras sa pagbabasa ng Bibliya.',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pag-aralan ito nang malalim - gamitin ang mga study tools at resources.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Isapuso ito - isaulo ang mga mahahalagang talata.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Isabuhay ito - ilapat ang mga aral sa pang-araw-araw na buhay.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ibahagi ito - ituro ang Salita ng Diyos sa iba.',
            'sort_order' => 16,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Gaano karaming oras ang inilalaan mo sa pagbabasa ng Salita ng Diyos araw-araw?

2. Ano ang mga talata sa Bibliya na tumulong sa iyo sa iyong paglalakbay bilang disipulo?

3. Paano mo maibabahagi ang Salita ng Diyos sa iba?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa Iyong Salita na nagbibigay liwanag at gabay sa aking buhay.

Tulungan Mo akong mahalin ang Iyong Salita at pag-aralan ito nang may kasipagan. Nawa ang Iyong Salita ay manatili sa aking puso at magbunga ng pagbabago sa aking buhay.

Gamitin Mo ang Iyong Salita upang hubugin ako at gawing katulad ni Hesus. Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson3($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(3);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Panalangin ng Disipulo',
            'subtitle' => 'The Disciple\'s Prayer Life',
            'summary' => 'Ang panalangin ang buhay-hininga ng isang disipulo. Ito ang ating pakikipag-ugnayan sa Diyos at pinagmumulan ng ating espirituwal na lakas.',
            'image' => 'https://images.unsplash.com/photo-1509017174183-0b7e0278b6e5?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PANALANGIN NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Manalangin kayo nang walang tigil."',
            'reference' => '1 Tesalonica 5:17',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay hindi lamang isang gawain kundi isang pamumuhay. Ito ang ating pakikipag-usap sa Diyos at ang ating pinagmumulan ng lakas bilang mga disipulo.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KAHALAGAHAN NG PANALANGIN SA BUHAY NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. NAGPAPALAPIT SA DIYOS (DRAWS US CLOSER TO GOD)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Lumapit kayo sa Diyos at siya\'y lalapit sa inyo."',
            'reference' => 'Santiago 4:8',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay nagpapalapit sa atin sa Diyos. Sa pamamagitan nito, nadarama natin ang Kanyang presensya at nalalaman ang Kanyang kalooban para sa ating buhay.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. NAGBIBIGAY NG LAKAS (GIVES STRENGTH)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit ang mga naghihintay sa Panginoon ay panibagong lakas ang tatanggap."',
            'reference' => 'Isaias 40:31',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa panalangin, tayo ay nabibigyan ng lakas upang harapin ang mga pagsubok at manatiling matatag sa ating pananampalataya.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. NAGDUDULOT NG KAPAYAPAAN (BRINGS PEACE)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Huwag kayong mabalisa sa anumang bagay; sa halip, sa lahat ng pagkakataon, sa pamamagitan ng panalangin at pagsamo, na may pasasalamat, ipakilala ninyo sa Diyos ang inyong mga kahilingan."',
            'reference' => 'Filipos 4:6',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay nagdudulot ng kapayapaang hindi kayang ibigay ng mundo. Ito ang nagpapakalma sa ating mga puso sa gitna ng unos.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG MGA URI NG PANALANGIN NG DISIPULO',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsamba - pagpaparangal sa Diyos dahil sa Kanyang kadakilaan',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagkukumpisal - pag-amin ng mga kasalanan at paghingi ng kapatawaran',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pasasalamat - pagpapasalamat sa mga biyaya ng Diyos',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsusumamo - paghingi ng tulong para sa sarili at sa iba',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pamamagitan - panalangin para sa ibang tao',
            'sort_order' => 16,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Gaano kahalaga ang panalangin sa iyong buhay bilang disipulo?

2. Ano ang mga hadlang na pumipigil sa iyo na manalangin nang regular?

3. Paano mo mapapalakas ang iyong buhay panalangin sa linggong ito?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Ama, ako ay nagpapasalamat sa pagkakataong makalapit sa Iyo sa panalangin. Tulungan Mo akong manatiling tapat sa aking buhay panalangin.

Bigyan Mo ako ng disiplina at pagnanais na hanapin Ka araw-araw. Nawa ang aking panalangin ay maging daan ng Iyong kapangyarihan at pagbabago sa aking buhay.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson4($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(4);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Buhay ng Pagsunod',
            'subtitle' => 'The Life of Obedience',
            'summary' => 'Ang pagsunod ay ang tanda ng tunay na pag-ibig sa Diyos. Ito ang nagpapatunay na tayo ay tunay na mga disipulo ni Hesus.',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY NG PAGSUNOD',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung iniibig ninyo ako, tutuparin ninyo ang aking mga utos."',
            'reference' => 'Juan 14:15',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsunod ay hindi tungkol sa pagiging perpekto kundi tungkol sa pagiging tapat. Ito ang nagpapakita ng ating tunay na pag-ibig sa Diyos at nagpapatunay na tayo ay Kanyang mga disipulo.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KAHALAGAHAN NG PAGSUNOD',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. PATUNAY NG PAG-IBIG (PROOF OF LOVE)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang umiibig sa akin ay tumutupad sa aking mga utos."',
            'reference' => 'Juan 14:23',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ating pagsunod ay nagpapakita ng ating tunay na pag-ibig sa Diyos. Hindi sapat ang pagsasabi lamang na mahal natin Siya; kailangan nating patunayan ito sa pamamagitan ng ating pagsunod.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. SUSI SA PAGPAPALA (KEY TO BLESSING)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung lubos kayong susunod sa akin, kayo\'y aking pagpapalain."',
            'reference' => 'Deuteronomio 28:1-2',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsunod sa Diyos ay nagbubukas ng pintuan ng Kanyang mga pagpapala. Hindi ito isang transaksyon kundi isang natural na bunga ng pamumuhay ayon sa Kanyang kalooban.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. GARANTIYA NG TAGUMPAY (GUARANTEE OF VICTORY)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"At malalaman natin na tayo ay nakikilala natin siya, kung tinutupad natin ang kanyang mga utos."',
            'reference' => '1 Juan 2:3',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsunod ay nagbibigay sa atin ng katiyakan ng tagumpay laban sa kasalanan at sa mga atake ng kaaway. Ito ang nagpapatatag sa ating pananampalataya.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA LARANGAN NG PAGSUNOD',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsunod sa Salita ng Diyos - pagbabasa at pagsasabuhay ng Bibliya',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsunod sa Banal na Espiritu - pakikinig at pagtugon sa Kanyang pamumuno',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsunod sa mga lider - paggalang at pagpapasakop sa mga awtoridad na inilagay ng Diyos',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsunod sa kalooban ng Diyos - paghahanap at pagtupad sa Kanyang plano para sa iyong buhay',
            'sort_order' => 15,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Sa anong mga larangan ka nahihirapang sumunod sa Diyos?

2. Paano mo maipapakita ang iyong pag-ibig sa Diyos sa pamamagitan ng pagsunod?

3. Ano ang isang tiyak na hakbang ng pagsunod na gagawin mo ngayon?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa Iyong pag-ibig at pagtitiyaga sa akin. Nais kong sumunod sa Iyo nang buong puso.

Tulungan Mo akong malampasan ang mga hadlang sa aking pagsunod. Bigyan Mo ako ng lakas upang tuparin ang Iyong mga utos at maging tunay na disipulo ni Hesus.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson5($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(5);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Buhay ng Paglilingkod',
            'subtitle' => 'The Life of Service',
            'summary' => 'Ang paglilingkod ay ang puso ng pagiging disipulo. Si Hesus mismo ay nagpakita ng halimbawa ng paglilingkod at inutusan tayong gawin din ito.',
            'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY NG PAGLILINGKOD',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat ang Anak ng Tao ay naparito hindi upang paglingkuran, kundi upang maglingkod at ibigay ang kanyang buhay bilang pantubos sa marami."',
            'reference' => 'Marcos 10:45',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Si Hesus ang ating perpektong halimbawa ng paglilingkod. Bilang Kanyang mga disipulo, tayo ay tinawag upang tularan ang Kanyang halimbawa ng pagiging lingkod sa lahat.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KAHALAGAHAN NG PAGLILINGKOD',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. HINDI TAYO NAPARITO UPANG PAGLINGKURAN',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang mga disipulo, hindi tayo naririto upang magpa-serbisyo kundi upang magserbisyo. Ang paglilingkod ay hindi isang opsyon kundi isang utos mula sa ating Panginoon.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. ANG PAGLILINGKOD AY PAGPAPAKUMBABA',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Magpakababa kayo sa harapan ng Panginoon at kayo\'y kanyang itataas."',
            'reference' => 'Santiago 4:10',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang paglilingkod ay isang pagpapakumbaba. Ito ang pagkilala na ang lahat ng ating kakayahan ay mula sa Diyos at ginagamit natin ito para sa Kanyang kaluwalhatian.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. ANG PAGLILINGKOD AY PAG-IBIG SA KAPWA',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sa pamamagitan ng pag-ibig, maglingkod kayo sa isa\'t isa."',
            'reference' => 'Mga Taga-Galacia 5:13',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang paglilingkod ay ang pinakamabisang paraan upang maipahayag ang pag-ibig. Ito ang nagpapatunay na tayo ay tunay na mga disipulo ni Hesus.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA URI NG PAGLILINGKOD',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paglilingkod sa Diyos - pagsamba, panalangin, at pagbabasa ng Salita',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paglilingkod sa iglesia - paggamit ng mga kaloob sa katawan ni Kristo',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paglilingkod sa kapwa - pagtulong sa mga nangangailangan',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Paglilingkod sa mundo - pagiging mabuting halimbawa sa lipunan',
            'sort_order' => 14,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Paano ka kasalukuyang naglilingkod sa Diyos at sa kapwa?

2. Ano ang mga kaloob na ibinigay sa iyo ng Diyos para sa paglilingkod?

3. Sa anong paraan mo pa mapapalawak ang iyong paglilingkod?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa pagkakataong makapaglingkod sa Iyo at sa Iyong bayan. Nais kong tularan ang Iyong halimbawa ng paglilingkod.

Tulungan Mo akong makita ang mga pangangailangan ng aking kapwa at magkaroon ng pusong handang maglingkod. Nawa ang aking paglilingkod ay magdala ng kaluwalhatian sa Iyong pangalan.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson6($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(6);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Buhay ng Pag-ibig',
            'subtitle' => 'The Life of Love',
            'summary' => 'Ang pag-ibig ang tanda ng tunay na disipulo. Ito ang nagpapatunay na tayo ay mga anak ng Diyos at tagasunod ni Hesus.',
            'image' => 'https://images.unsplash.com/photo-1486299267070-83823f5448dd?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY NG PAG-IBIG',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sa pamamagitan nito makikilala ng lahat na kayo ay aking mga alagad, kung kayo ay nagmamahalan."',
            'reference' => 'Juan 13:35',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-ibig ang pinakamalakas na patunay ng pagiging disipulo ni Hesus. Hindi ang ating kaalaman o kakayahan, kundi ang ating pag-ibig ang nagpapatunay na tayo ay Kanyang mga tagasunod.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KATANGIAN NG PAG-IBIG NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. PAG-IBIG NA WALANG PASUBALI (UNCONDITIONAL LOVE)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit sinasabi ko sa inyo, ibigin ninyo ang inyong mga kaaway at ipanalangin ninyo ang mga umuusig sa inyo."',
            'reference' => 'Mateo 5:44',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-ibig ng disipulo ay hindi nakabatay sa nararamdaman o sa pagtugon ng iba. Ito ay isang pagpapasya na magmahal tulad ng pag-ibig ni Hesus.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PAG-IBIG NA NAGSASAKRIPISYO (SACRIFICIAL LOVE)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Walang pag-ibig na hihigit pa sa pag-ibig ng isang taong nag-aalay ng kanyang buhay para sa kanyang mga kaibigan."',
            'reference' => 'Juan 15:13',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang tunay na pag-ibig ay handang magsakripisyo para sa kapakanan ng iba. Ito ang pag-ibig na ipinakita ni Hesus sa krus para sa atin.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. PAG-IBIG NA NAGPAPATAWAD (FORGIVING LOVE)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung magkagayo\'y lumapit si Pedro kay Jesus at nagtanong, \'Panginoon, ilang ulit ko bang patatawarin ang aking kapatid na nagkakasala sa akin? Hanggang pitong ulit ba?\'
Sinabi ni Jesus sa kanya, \'Hindi ko sinasabing hanggang pitong ulit, kundi hanggang sa makapitong pung pitong ulit.\'"',
            'reference' => 'Mateo 18:21-22',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-ibig ng disipulo ay puno ng kapatawaran. Hindi ito nagtatanim ng sama ng loob kundi nagpapatawad ng paulit-ulit tulad ng ginawa ng Diyos sa atin.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO MAGMAHAL TULAD NI HESUS',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Manalangin na punuin ka ng pag-ibig ng Diyos',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pag-aralan ang buhay ni Hesus at ang Kanyang pag-ibig',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Magsanay na magmahal sa pamamagitan ng mga simpleng gawa',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Patawarin ang mga nagkasala sa iyo',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maglingkod sa iba nang walang inaasahang kapalit',
            'sort_order' => 16,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Sino ang taong mahirap mong mahalin? Paano mo sila mamahalin tulad ni Hesus?

2. Paano mo naipapakita ang pag-ibig sa iyong pang-araw-araw na buhay?

3. Ano ang isang hakbang na maaari mong gawin upang mas lumago sa pag-ibig?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa Iyong walang hanggang pag-ibig sa akin. Nais kong magmahal tulad ng Iyong pag-ibig.

Punuan Mo ang aking puso ng Iyong pag-ibig upang ito ay umapaw sa aking kapwa. Tulungan Mo akong magpatawad at magmahal ng walang pasubali.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson7($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(7);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Buhay ng Pananampalataya',
            'subtitle' => 'The Life of Faith',
            'summary' => 'Ang pananampalataya ang pundasyon ng buhay ng disipulo. Ito ang nagpapatunay na tayo ay nagtitiwala sa Diyos sa lahat ng pagkakataon.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY NG PANANAMPALATAYA',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngayon ang pananampalataya ay ang katiyakan sa mga bagay na inaasahan, ang katunayan ng mga bagay na hindi nakikita."',
            'reference' => 'Mga Hebreo 11:1',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pananampalataya ang pundasyon ng ating buhay bilang mga disipulo. Ito ang nagpapatunay na tayo ay nagtitiwala sa Diyos kahit hindi natin nakikita ang Kanyang mga ginagawa.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KATANGIAN NG PANANAMPALATAYA NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. NAGTITIWALA SA KAKAYAHAN NG DIYOS (TRUSTS IN GOD\'S ABILITY)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit ang nagtitiwala kay Yahweh ay pagpapalain."',
            'reference' => 'Jeremias 17:7',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pananampalataya ay nagtitiwala sa kakayahan ng Diyos na gawin ang mga bagay na tila imposible sa paningin ng tao.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. NANININDIGAN SA KAHIRAPAN (STANDS FIRM IN ADVERSITY)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sa pamamagitan ng pananampalataya, sila\'y nakipaglaban sa mga kaharian, gumawa ng katuwiran, at tumanggap ng mga pangako."',
            'reference' => 'Mga Hebreo 11:33',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pananampalataya ay naninindigan sa gitna ng mga pagsubok. Ito ang nagbibigay sa atin ng lakas upang magpatuloy kahit mahirap.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. NAGBUBUNGA NG MGA HIMALA (PRODUCES MIRACLES)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sinabi ni Jesus sa kanya, \'Kung makakaya mo? Ang lahat ng bagay ay posible sa sumasampalataya.\'"',
            'reference' => 'Marcos 9:23',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pananampalataya ay nagbubukas ng pinto para sa mga himala ng Diyos. Ito ang nagbibigay-daan upang maranasan natin ang Kanyang supernatural na kapangyarihan.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO PALAKASIN ANG PANANAMPALATAYA',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pakikinig sa Salita ng Diyos - ang pananampalataya ay nagmumula sa pakikinig sa Salita (Roma 10:17)',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Panalangin - ipahayag ang iyong pananampalataya sa panalangin',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pag-alaala sa mga ginawa ng Diyos - tandaan ang Kanyang katapatan sa nakaraan',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagsasabuhay ng pananampalataya - gumawa ng mga hakbang ng pananampalataya',
            'sort_order' => 15,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Paano mo naipapakita ang iyong pananampalataya sa Diyos sa iyong pang-araw-araw na buhay?

2. Ano ang mga pagsubok na kailangan mong harapin nang may pananampalataya?

3. Ano ang isang hakbang ng pananampalataya na gagawin mo ngayon?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa biyaya ng pananampalataya na Iyong ibinigay sa akin. Nais kong lumago sa aking pananampalataya araw-araw.

Tulungan Mo akong magtiwala sa Iyo nang higit pa, lalo na sa mga panahon ng pagsubok. Palakasin Mo ang aking pananampalataya upang makakita ako ng mga himala sa Iyong pangalan.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson8($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(8);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Buhay ng Komunidad',
            'subtitle' => 'The Life of Community',
            'summary' => 'Ang pagiging disipulo ay hindi isang solong paglalakbay. Kailangan natin ang isa\'t isa upang lumago at manatiling matatag sa pananampalataya.',
            'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY NG KOMUNIDAD',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sila ay patuloy na nagkakatipon sa pagtuturo ng mga apostol, sa pakikisama, sa paghahati-hati ng tinapay, at sa mga panalangin."',
            'reference' => 'Mga Gawa 2:42',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang buhay ng disipulo ay hindi nilalayong maging mag-isa. Tayo ay nilikha para sa komunidad—upang lumago, maglingkod, at magmahal kasama ang ibang mananampalataya.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KAHALAGAHAN NG KOMUNIDAD SA BUHAY NG DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. PAGLAGO SA PAMAMAGITAN NG PAGTUTURO (GROWTH THROUGH TEACHING)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa komunidad, tayo ay natututo mula sa isa\'t isa. Ang pagtuturo ng Salita ng Diyos ay hindi lamang nangyayari sa pulpito kundi sa ating pang-araw-araw na pakikisama.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PAGPAPATATAG SA PAMAMAGITAN NG PAKIKISAMA (STRENGTHENING THROUGH FELLOWSHIP)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Huwag nating kaliligtaan ang pagdalo sa ating mga pagtitipon... sa halip, palakasin natin ang loob ng isa\'t isa."',
            'reference' => 'Mga Hebreo 10:25',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pakikisama sa mga kapatid ay nagbibigay sa atin ng lakas at pagpapalakas ng loob. Ito ang nagpapatatag sa atin sa ating pananampalataya.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. PAGPAPAHAYAG NG PAG-IBIG SA PAMAMAGITAN NG PAGLILINGKOD (LOVE EXPRESSED THROUGH SERVICE)',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Maglingkod kayo sa isa\'t isa sa pamamagitan ng pag-ibig."',
            'reference' => 'Mga Taga-Galacia 5:13',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa komunidad, natututo tayong maglingkod at magmahal. Ito ang lugar kung saan ang ating pag-ibig ay nagiging praktikal at totoo.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA BENEPISYO NG KOMUNIDAD',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Suporta sa panahon ng pagsubok',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pananagutan sa isa\'t isa',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagkakataon na gamitin ang mga kaloob',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pagdiriwang ng mga tagumpay nang sama-sama',
            'sort_order' => 14,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Paano ka nakikilahok sa komunidad ng mga mananampalataya?

2. Ano ang mga kontribusyon mo sa iyong komunidad bilang disipulo?

3. Paano ka makakatulong upang palakasin ang iyong komunidad?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa komunidad ng mga mananampalataya na Iyong inilagay sa aking buhay.

Tulungan Mo akong maging aktibong bahagi ng komunidad na ito. Nawa ang aking buhay ay maging pagpapala sa aking mga kapatid at mag-ambag sa pagpapalago ng Iyong kaharian.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson9($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(9);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Pagpapalaganap ng Disipulasyon',
            'subtitle' => 'The Multiplication of Discipleship',
            'summary' => 'Ang tunay na disipulasyon ay nagpaparami. Ang isang disipulo ay hindi lamang sumusunod kay Hesus kundi nagtuturo rin sa iba na sumunod.',
            'image' => 'https://images.unsplash.com/photo-1486299267070-83823f5448dd?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PAGPAPALAGANAP NG DISIPULASYON',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang mga narinig mo sa akin sa harap ng maraming saksi ay ituro mo rin sa mga taong mapagkakatiwalaan at may kakayahang magturo naman sa iba."',
            'reference' => '2 Timoteo 2:2',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang disipulasyon ay hindi dapat tumigil sa atin. Ito ay dapat dumaan mula sa isang henerasyon patungo sa susunod. Tayo ay tinawag upang magparami ng mga disipulo.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PRINSIPYO NG PAGPAPALAGANAP',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. ANG MODELO NI HESUS (JESUS\' MODEL)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pinili ni Hesus ang labindalawa at sinanay sila upang maging mga disipulo. Pagkatapos, sila naman ang nagturo sa iba. Ito ang modelo ng pagpapalaganap ng disipulasyon.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. ANG PROSESO NG PAGPAPALAGANAP (THE PROCESS)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging disipulo - lumago sa iyong sariling pananampalataya',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Gumawa ng disipulo - turuan ang iba na sumunod kay Hesus',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Turuan ang disipulo na gumawa ng disipulo - ang proseso ay nagpapatuloy',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. ANG APAT NA HENERASYON NG DISIPULASYON',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"At ang mga bagay na iyong narinig sa akin... ay ipagkatiwala mo sa mga tapat na tao, na siya namang makapagtuturo sa iba."',
            'reference' => '2 Timoteo 2:2',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Si Pablo ay nagturo kay Timoteo. Si Timoteo ay nagturo sa mga tapat na tao. Ang mga tapat na tao ay nagturo sa iba. Ito ang apat na henerasyon ng disipulasyon na nagpapatuloy hanggang ngayon.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PAGPAPALAGANAP SA IYONG BUHAY',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Kilalanin ang mga taong maaari mong disipuluhin',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Gumugol ng oras sa kanila at turuan sila ng Salita',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging halimbawa ng isang disipulo sa kanila',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Turuan silang gumawa ng iba pang disipulo',
            'sort_order' => 15,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Sino ang iyong "Timoteo" na maaari mong disipuluhin?

2. Ano ang iyong plano upang magparami ng mga disipulo?

3. Paano mo matuturuan ang iba na gumawa rin ng mga disipulo?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa mga taong Iyong ginamit upang ako ay maging disipulo. Ngayon, nais kong maging instrumento upang makagawa rin ng mga disipulo.

Ipakita Mo sa akin ang mga taong maaari kong disipuluhin. Bigyan Mo ako ng karunungan at pagtitiyaga upang sila ay sanayin at gabayan. Nawa ang Iyong kaharian ay lumago sa pamamagitan ng aking buhay.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }

    private function createLesson10($pepsol, $pepsolName)
    {
        $topic = $this->getTopic(10);
        $lesson = PepsolLesson::create([
            'pepsol_id' => $pepsol->id,
            'pepsol_name_id' => $pepsolName->id,
            'pepsol_topic_id' => $topic->id,
            'title' => 'Ang Ganap na Disipulo',
            'subtitle' => 'The Complete Disciple',
            'summary' => 'Ang ganap na disipulo ay isang taong ganap na nagtatalaga ng kanyang buhay kay Hesus, lumalago sa Kanya, at nagbubunga ng marami para sa Kanyang kaharian.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG GANAP NA DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit ang mga salitang ito ang aking ibinibilin sa inyo: ang punong-kahoy na mabuti ay hindi makapagbubunga ng masamang bunga, at ang punong-kahoy na masama ay hindi makapagbubunga ng mabuting bunga."',
            'reference' => 'Mateo 7:18',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ganap na disipulo ay bunga ng isang buhay na ganap na nakatuon kay Hesus. Ito ay isang buhay na patuloy na lumalago at nagbubunga para sa kaharian ng Diyos.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KATANGIAN NG GANAP NA DISIPULO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. BUONG-PUSONG PAGTATALAGA (WHOLEHEARTED COMMITMENT)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ibigin mo ang Panginoon mong Diyos nang buong puso, nang buong kaluluwa, at nang buong pag-iisip."',
            'reference' => 'Mateo 22:37',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ganap na disipulo ay nagmamahal sa Diyos nang buong puso. Ang kanyang buong pagkatao ay nakatuon sa paglilingkod at pagsunod sa Kanya.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PATULOY NA PAGLAGO (CONTINUOUS GROWTH)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya nga, mga kapatid, magsikap kayong lalo pang lumago sa inyong pananampalataya."',
            'reference' => '2 Pedro 1:5-7',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ganap na disipulo ay hindi tumitigil sa paglago. Siya ay patuloy na lumalapit kay Hesus at nagiging katulad Niya araw-araw.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. MARAMING BUNGA (ABUNDANT FRUIT)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Dito niluluwalhati ang aking Ama, sa pagbunga ninyo ng marami at kayo\'y magiging aking mga alagad."',
            'reference' => 'Juan 15:8',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ganap na disipulo ay nagbubunga ng marami—bunga ng pagbabago sa sarili, bunga ng paglilingkod, at bunga ng mga bagong disipulo.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG LANDAS TUNGO SA PAGIGING GANAP NA DISIPULO',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Magkaroon ng matibay na pundasyon sa Salita ng Diyos',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Manatiling tapat sa panalangin at pagsamba',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging bahagi ng komunidad ng mga mananampalataya',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maglingkod at gumamit ng mga kaloob para sa kaharian',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Gumawa ng mga disipulo at turuan silang sumunod kay Hesus',
            'sort_order' => 16,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PERSONAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => '1. Saan ka na sa iyong paglalakbay bilang disipulo?

2. Ano ang mga susunod na hakbang na kailangan mong gawin upang maging ganap na disipulo?

3. Ano ang iyong pangako sa Diyos bilang tugon sa mga araling ito?',
            'sort_order' => 2,
        ]);

        $conclusionPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'conclusion',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'heading',
            'content' => 'PRAYER',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $conclusionPart->id,
            'block_type' => 'prayer',
            'content' => 'Panginoon, ako ay nagpapasalamat sa pagtawag Mo sa akin upang maging Iyong disipulo. Tinatanggap ko ang hamon na maging ganap na disipulo ni Hesus.

Tulungan Mo akong manatiling tapat sa Iyong Salita at sa Iyong mga utos. Nawa ang aking buhay ay magbunga ng marami para sa Iyong kaharian.

Gamitin Mo ako upang gumawa ng mga disipulo na magpapatuloy sa gawaing ito hanggang sa Iyong pagbabalik.

Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }
}
