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

class PepsolWinSeeder extends Seeder
{
    public function run(): void
    {
        $category = PepsolCategory::where('code', 'B-1')->first();
        $type = PepsolType::where('code', 'SOL 1-A')->first();
        $pepsolName = PepsolName::where('code', 'EVG-1')->first();
        $user = User::first();

        $pepsol = Pepsol::create([
            'pepsol_category_id' => $category->id,
            'pepsol_type_id' => $type->id,
            'created_by' => $user->id,
            'description' => 'WIN - Equipping believers to win souls and make disciples through effective evangelism and sharing the Gospel.',
            'guidelines' => 'Study each lesson carefully and practice sharing your testimony and the Gospel message.',
            'orientation' => 'These lessons are designed to equip born-again Christians to confidently share their faith and make disciples.',
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
            'title' => 'Ang Dakilang Utos (The Great Commission)',
            'subtitle' => 'Ang Misyon ng Bawat Mananampalataya',
            'summary' => 'Ang Dakilang Utos ay ang mandato ni Hesus sa Kanyang mga tagasunod na gumawa ng mga alagad mula sa lahat ng bansa. Ito ang puso ng misyon ng bawat mananampalataya.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG DAKILANG UTOS (THE GREAT COMMISSION)',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t habang kayo\'y humahayo, gawin ninyong alagad ko ang mga tao sa lahat ng bansa. Bautismuhan ninyo sila sa pangalan ng Ama, at ng Anak, at ng Espiritu Santo. Turuan ninyo silang sumunod sa lahat ng iniutos ko sa inyo. Tandaan ninyo, ako\'y laging kasama ninyo hanggang sa katapusan ng panahon."',
            'reference' => 'Mateo 28:19–20',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANO ANG DAKILANG UTOS?',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Dakilang Utos ay ang huling utos ni Hesus sa Kanyang mga alagad bago Siya umakyat sa langit. Ito ang pangunahing misyon ng bawat Kristiyano—ang ibahagi ang ebanghelyo at gumawa ng mga alagad.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang mga ipinanganak na muli (born again) kay Kristo, tayo ay tinawag hindi lamang upang maligtas kundi upang maging tagapagdala ng kaligtasan sa iba. Tayo ay naging bahagi ng dakilang misyon ng Diyos na iligtas ang sangkatauhan.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Dakilang Utos ay binubuo ng tatlong mahahalagang bahagi:',
            'sort_order' => 6,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'TATLONG BAHAGI NG DAKILANG UTOS',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. HUMAYO (GO)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi tayo tinawag upang manatili lamang sa ating mga simbahan. Tayo ay isinugo upang lumabas at maabot ang mga nawawalang kaluluwa. Ang "humayo" ay nangangahulugang aktibong paghahanap sa mga taong hindi pa nakakakilala kay Kristo.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. GUMAWA NG MGA ALAGAD (MAKE DISCIPLES)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi lamang tayo tinawag upang mangaral, kundi upang gumawa ng mga alagad—mga taong susunod kay Hesus at magiging katulad Niya. Ito ay isang proseso ng pagtuturo at paghubog.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. BAUTISMUHAN AT TURO (BAPTIZE AND TEACH)',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang bautismo ay ang panlabas na pagpapahayag ng panloob na pagbabago. Ang pagtuturo naman ay ang patuloy na paghubog sa mga bagong mananampalataya upang sila ay lumago at magbunga.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PANGANGAILANGAN NG MUNDO',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang anihin ay marami, ngunit kakaunti ang manggagawa. Kaya\'t idalangin ninyo sa Panginoon ng aanihin na magpadala siya ng mga manggagawa sa kanyang aanihin."',
            'reference' => 'Mateo 9:37–38',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilyun-bilyong tao ang hindi pa nakakakilala kay Hesus. Sila ay naghihintay ng isang tao na magbabahagi ng pag-asa at kaligtasan. Ikaw ba ay handang maging tagapagdala ng Mabuting Balita?',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang isang ipinanganak na muli, ikaw ay may kakaibang kuwento ng pagbabago. Ang iyong patotoo ay maaaring maging daan upang ang iba ay makaranas din ng bagong buhay kay Kristo.',
            'sort_order' => 11,
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
            'content' => '1. Paano mo tinutugon ang Dakilang Utos sa iyong pang-araw-araw na buhay?

2. Sino sa iyong mga kakilala ang nangangailangan ng marinig ang ebanghelyo?

3. Ano ang mga hadlang na pumipigil sa iyo na ibahagi ang iyong pananampalataya?',
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
            'content' => 'Panginoon, ako ay nagpapasalamat sa kaligtasang Iyong ibinigay sa akin. Ngayon, tinatanggap ko ang Iyong utos na humayo at gumawa ng mga alagad.

Bigyan Mo ako ng lakas ng loob at karunungan upang maibahagi ang Iyong pag-ibig sa mga taong nasa paligid ko. Buksan Mo ang aking mga mata upang makita ko ang mga nawawalang kaluluwa.

Gamitin Mo ako upang maging daan ng Iyong kaligtasan sa iba. Sa pangalan ni Hesus, Amen.',
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
            'title' => 'Ang Kapangyarihan ng Iyong Patotoo',
            'subtitle' => 'The Power of Your Testimony',
            'summary' => 'Ang iyong personal na kuwento ng kaligtasan ay isang makapangyarihang kasangkapan upang maabot ang mga nawawalang kaluluwa.',
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG KAPANGYARIHAN NG IYONG PATOTOO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Nanalo sila sa pamamagitan ng dugo ng Kordero at sa salita ng kanilang patotoo; hindi nila inibig ang kanilang buhay hanggang sa kamatayan."',
            'reference' => 'Apocalipsis 12:11',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iyong patotoo ay ang iyong personal na kuwento kung paano ka naligtas ni Hesus. Ito ang pinakamakapangyarihang kasangkapan sa pag-eebanghelyo dahil walang makakatalo sa iyong personal na karanasan.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang isang ipinanganak na muli, ang iyong buhay ay patunay ng pagbabagong dulot ng ebanghelyo. Ang iyong kuwento ay nagbibigay pag-asa sa mga taong nasa dilim.',
            'sort_order' => 4,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'TATLONG BAHAGI NG IYONG PATOTOO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. ANG IYONG BUHAY BAGO SI HESUS (BEFORE)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ano ang iyong buhay bago mo nakilala si Hesus? Ano ang mga problema, kahungkagan, o kasalanan na iyong kinaharap? Ito ang bahagi na nagpapakita ng pangangailangan ng tao sa Tagapagligtas.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PAANO KA NAKILALA NI HESUS (HOW)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Paano mo narinig ang ebanghelyo? Ano ang nangyari noong araw na iyon? Paano ka tumugon sa tawag ng Diyos? Ibahagi ang mga detalye ng iyong kaligtasan.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. ANG IYONG BUHAY NGAYON KAY HESUS (AFTER)',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Paano nagbago ang iyong buhay mula nang tanggapin mo si Hesus? Ano ang mga pagbabagong naganap sa iyong pagkatao, relasyon, at pananaw sa buhay? Ito ang bahagi na nagbibigay ng pag-asa sa nakikinig.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO IBAHAGI ANG IYONG PATOTOO',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging totoo at tapat—huwag magdagdag ng mga bagay na hindi nangyari.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Panatilihing maikli at malinaw—gawin itong 3-5 minuto lamang.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ituon ang atensyon kay Hesus—ang layunin ay ituro ang mga tao kay Kristo, hindi sa sarili.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging handa sa anumang oras—ang iyong patotoo ay laging handa sa iyong puso.',
            'sort_order' => 12,
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
            'content' => '1. Isulat ang iyong personal na patotoo gamit ang "Before, How, After" format.

2. Magsanay na ibahagi ang iyong patotoo sa loob ng 3-5 minuto.

3. Sino ang unang tao na nais mong bahaginan ng iyong patotoo?',
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
            'content' => 'Panginoon, salamat sa Iyong pag-ibig at kaligtasan. Salamat sa pagbabagong Iyong ginawa sa aking buhay.

Bigyan Mo ako ng lakas ng loob na ibahagi ang aking patotoo sa mga taong nangangailangan. Nawa ang aking kuwento ay maging daan upang ang iba ay makilala Ka.

Gamitin Mo ang aking buhay upang maging patunay ng Iyong kapangyarihang magbago. Sa pangalan ni Hesus, Amen.',
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
            'title' => 'Ang Mensahe ng Ebanghelyo',
            'subtitle' => 'The Gospel Message',
            'summary' => 'Ang ebanghelyo ay ang Mabuting Balita ng kaligtasan sa pamamagitan ng kamatayan at muling pagkabuhay ni Hesu-Kristo.',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG MENSAHE NG EBANGHELYO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat ibig kong ipaalam sa inyo, mga kapatid, ang ebanghelyong ipinangaral ko sa inyo, na inyong tinanggap at pinaninindigan, at sa pamamagitan nito\'y inyong naliligtas."',
            'reference' => '1 Corinto 15:1-2',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ebanghelyo ay ang puso ng ating pananampalataya. Ito ang mensahe ng kaligtasan na nagbabago ng buhay ng bawat tumatanggap nito. Bilang mga ipinanganak na muli, tayo ay tinawag upang ipahayag ang mensaheng ito sa lahat.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG APAT NA PUNDASYON NG EBANGHELYO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. ANG PAG-IBIG NG DIYOS (GOD\'S LOVE)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat gayon na lamang ang pag-ibig ng Diyos sa sanlibutan, na ibinigay niya ang kanyang kaisa-isang Anak, upang ang sinumang sumampalataya sa kanya ay hindi mapahamak, kundi magkaroon ng buhay na walang hanggan."',
            'reference' => 'Juan 3:16',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-ibig ng Diyos ang nagtulak sa Kanya upang ipadala si Hesus. Hindi tayo karapat-dapat sa Kanyang pag-ibig, ngunit minahal Niya tayo ng walang pasubali.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. ANG KASALANAN NG TAO (MAN\'S SIN)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat ang lahat ay nagkasala at hindi nakaabot sa kaluwalhatian ng Diyos."',
            'reference' => 'Roma 3:23',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang kasalanan ay naghiwalay sa atin mula sa Diyos. Tayo ay ipinanganak na may makasalanang kalikasan at hindi natin kayang iligtas ang ating mga sarili.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. ANG KAMATAYAN NI HESUS (CHRIST\'S DEATH)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit ipinakikita ng Diyos ang kanyang pag-ibig sa atin, sapagkat noong tayo\'y makasalanan pa, si Cristo ay namatay para sa atin."',
            'reference' => 'Roma 5:8',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Si Hesus ay namatay sa krus upang maging kabayaran ng ating mga kasalanan. Ang Kanyang kamatayan ay nagbigay daan upang tayo ay mapatawad at mapalapit sa Diyos.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. ANG TUGON NG TAO (MAN\'S RESPONSE)',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung ipahahayag ng iyong bibig na si Jesus ay Panginoon, at sasampalataya ka sa iyong puso na siya\'y muling binuhay ng Diyos, maliligtas ka."',
            'reference' => 'Roma 10:9',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang kaligtasan ay natatanggap sa pamamagitan ng pananampalataya kay Hesus. Kailangan nating magsisi sa ating mga kasalanan at tanggapin Siya bilang Panginoon at Tagapagligtas.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO IBAHAGI ANG EBANGHELYO',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Magsimula sa pag-ibig ng Diyos at lumikha ng interes.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ipaliwanag ang problema ng kasalanan at ang pangangailangan ng kaligtasan.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ibahagi kung ano ang ginawa ni Hesus sa krus para sa atin.',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Hikayatin ang tao na tumugon sa pamamagitan ng panalangin at pagsisisi.',
            'sort_order' => 18,
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
            'content' => '1. Naipapaliwanag mo ba ng malinaw ang ebanghelyo sa ibang tao?

2. Alin sa apat na pundasyon ng ebanghelyo ang pinakamahalaga sa iyong karanasan?

3. Sino ang maaari mong turuan ng ebanghelyo sa linggong ito?',
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
            'content' => 'Panginoon, salamat sa mensahe ng ebanghelyo na nagbigay sa akin ng bagong buhay. Tulungan Mo akong maipahayag ito nang malinaw at may pag-ibig sa mga taong aking makakasalamuha.

Bigyan Mo ako ng mga pagkakataon upang maibahagi ang Mabuting Balita. Nawa ang aking mga salita ay magdala ng liwanag at pag-asa sa mga nasa dilim.

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
            'title' => 'Ang Panalangin ng Mananakop',
            'subtitle' => 'The Prayer of the Conqueror',
            'summary' => 'Ang panalangin ay ang sandata ng bawat mananakop ng kaluluwa. Sa pamamagitan ng panalangin, inihahanda natin ang mga puso ng mga tao na tanggapin ang ebanghelyo.',
            'image' => 'https://images.unsplash.com/photo-1509017174183-0b7e0278b6e5?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PANALANGIN NG MANANAKOP',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t sinasabi ko sa inyo, humingi kayo, at kayo\'y bibigyan; humanap kayo, at kayo\'y makakatagpo; kumatok kayo, at kayo\'y pagbubuksan."',
            'reference' => 'Lucas 11:9',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay ang pundasyon ng bawat matagumpay na gawain ng Diyos. Bago tayo humayo upang manakop ng mga kaluluwa, kailangan muna nating manalangin at ihanda ang mga puso.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'BAKIT KAILANGAN ANG PANALANGIN SA PAG-EBANGHELYO?',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ang nagbubukas ng puso ng mga tao upang tanggapin ang ebanghelyo.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ang nagbibigay sa atin ng kapangyarihan at lakas ng loob.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ang sumisira sa mga kuta ng kaaway sa buhay ng mga tao.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ang naghahanda ng daan para sa pag-aani ng mga kaluluwa.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA DAPAT IPANALANGIN SA PAG-EBANGHELYO',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. IPANALANGIN ANG MGA TAO (PRAY FOR PEOPLE)',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Manalangin para sa mga taong nais mong maabot. Hilingin na buksan ng Diyos ang kanilang mga puso at matanggal ang mga hadlang na pumipigil sa kanila na tanggapin si Hesus.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. IPANALANGIN ANG MGA PAGKAKATAON (PRAY FOR OPPORTUNITIES)',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hilingin sa Diyos na bigyan ka ng mga tamang pagkakataon upang maibahagi ang ebanghelyo. Ang Diyos ang nagbubukas ng mga pintuan para sa Kanyang mensahe.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. IPANALANGIN ANG IYONG SARILI (PRAY FOR YOURSELF)',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Manalangin na bigyan ka ng Diyos ng lakas ng loob, karunungan, at tamang mga salita upang maipahayag ang ebanghelyo nang may pag-ibig at kaliwanagan.',
            'sort_order' => 12,
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
            'content' => '1. Gumawa ng listahan ng mga taong nais mong maabot at simulan silang ipanalangin araw-araw.

2. Maglaan ng oras araw-araw upang manalangin para sa mga nawawalang kaluluwa.

3. Hilingin sa Diyos na bigyan ka ng mga pagkakataon upang makapagbahagi ng ebanghelyo.',
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
            'content' => 'Panginoon, ibinubuhos ko ang aking puso sa Iyo sa panalangin para sa mga nawawalang kaluluwa.

Buksan Mo ang kanilang mga mata upang makita nila ang liwanag ng ebanghelyo. Wasakin Mo ang mga kuta na humahadlang sa kanila na makilala Ka.

Bigyan Mo ako ng mga pagkakataon at tamang mga salita upang maibahagi ko ang Iyong pag-ibig. Nawa ang aking panalangin ay maging daan ng Iyong tagumpay sa pag-aani ng mga kaluluwa.

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
            'title' => 'Paano Magsimula ng Usapan tungkol kay Hesus',
            'subtitle' => 'How to Start a Conversation about Jesus',
            'summary' => 'Ang pag-eebanghelyo ay nagsisimula sa isang simpleng usapan. Matutong magbukas ng mga pintuan upang maibahagi ang iyong pananampalataya.',
            'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO MAGSIMULA NG USAPAN TUNGKOL KAY HESUS',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Maging laging handa kayong sumagot sa sinumang humihingi sa inyo ng dahilan tungkol sa inyong pag-asa."',
            'reference' => '1 Pedro 3:15',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang mga ipinanganak na muli, tayo ay tinawag upang maging mabuting balita sa mga taong nakapaligid sa atin. Ngunit kadalasan, ang pinakamahirap na bahagi ay ang pagsisimula ng usapan.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA PARAAN UPANG MAGSIMULA NG USAPAN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. GAMITIN ANG IYONG KWENTO (USE YOUR STORY)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ibahagi kung paano ka nagbago mula nang makilala mo si Hesus. Ang iyong personal na karanasan ay nakakaantig ng puso at lumilikha ng interes.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. MAGTANONG NG MGA TANONG (ASK QUESTIONS)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Magtanong tungkol sa kanilang buhay at paniniwala. Halimbawa: "Ano ang iyong pananaw sa buhay?" o "Naniniwala ka ba na may Diyos?"',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. GAMITIN ANG MGA PANGYAYARI SA BUHAY (USE LIFE EVENTS)',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Gamitin ang mga pangyayari sa buhay tulad ng krisis, saya, o pagsubok upang ipakita kung paano ka tinulungan ng Diyos sa mga pagkakataong iyon.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. MAG-ALOK NG PAGPAPALA (OFFER A BLESSING)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Mag-alok na ipanalangin ang kanilang mga pangangailangan. Ito ay isang simple ngunit makapangyarihang paraan upang maipakita ang pag-ibig ng Diyos.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA DAPAT TANDAAN SA PAKIKIPAG-USAP',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging mapagmahal at magalang—huwag makipagtalo.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Makinig nang mabuti—alamin ang kanilang mga pangangailangan.',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging natural at huwag pilitin—ang ebanghelyo ay dapat ibahagi nang may pag-ibig.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging handa—alam mo ang iyong sasabihin at ang iyong patotoo.',
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
            'content' => '1. Gumawa ng isang plano kung paano mo sisimulan ang usapan tungkol kay Hesus sa isang tao.

2. Magsanay gamit ang iyong patotoo sa harap ng salamin o sa isang kaibigan.

3. Magtakda ng layunin na makapagbahagi ng iyong pananampalataya sa isang tao sa linggong ito.',
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
            'content' => 'Panginoon, bigyan Mo ako ng karunungan at lakas ng loob upang makapagsimula ng mga usapan tungkol sa Iyo.

Tulungan Mo akong maging sensitibo sa mga pagkakataon na Iyong inihahanda para sa akin. Nawa ang aking mga salita ay magdala ng liwanag at pag-asa sa mga taong aking makakausap.

Gamitin Mo ang aking bibig upang magsalita ng Iyong pag-ibig at kaligtasan. Sa pangalan ni Hesus, Amen.',
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
            'title' => 'Pagtugon sa mga Pagtutol',
            'subtitle' => 'Responding to Objections',
            'summary' => 'Matutong tumugon sa mga karaniwang pagtutol ng mga tao sa ebanghelyo nang may pag-ibig at karunungan.',
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAGTUGON SA MGA PAGTUTOL',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Maging mahinahon kayo sa inyong pagsagot at mag-ingat sa inyong pananalita upang malaman ninyo kung paano kayo dapat sumagot sa bawat isa."',
            'reference' => 'Colosas 4:6',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kapag tayo ay nagbabahagi ng ebanghelyo, natural na may mga pagtutol na lumalabas. Ang mahalaga ay kung paano tayo tumugon—nang may pag-ibig, karunungan, at paggalang.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA KARANIWANG PAGTUTOL AT PAANO TUMUGON',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. "WALA AKONG KASALANAN"',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tugon: "Ayon sa Biblia, ang lahat ay nagkasala at hindi nakaabot sa kaluwalhatian ng Diyos (Roma 3:23). Hindi ito tungkol sa pagiging mabuti kundi tungkol sa pagiging perpekto. Tayo ay nagkukulang sa harap ng isang banal na Diyos."',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. "MAY MABUTI NAMAN AKONG PUSO"',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tugon: "Ang mabuting puso ay hindi sapat upang iligtas tayo. Kailangan natin ang kaligtasan na tanging si Hesus lamang ang makapagbibigay. Ang ating mabubuting gawa ay hindi makapagbabayad sa ating mga kasalanan."',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. "KAYA KO NAMAN MAG-ISA"',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tugon: "Nilikha tayo ng Diyos upang magkaroon ng relasyon sa Kanya at sa isa\'t isa. Ang buhay na walang Diyos ay walang tunay na kahulugan at kabuluhan. Kailangan natin ang Diyos sa ating buhay."',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. "MAMAYA NA LANG"',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tugon: "Hindi natin alam kung kailan tayo mamamatay. Ang kaligtasan ay magagamit lamang habang tayo ay nabubuhay. Huwag nating ipagpaliban ang pinakamahalagang desisyon sa buhay."',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '5. "MAHIRAP MAGSISISI"',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tugon: "Ang pagsisisi ay hindi tungkol sa pagiging perpekto kundi tungkol sa pagbabago ng direksyon. Ang Diyos ay handang tumanggap sa atin saan man tayo naroroon."',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA DAPAT TANDAAN SA PAGTUGON',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maging mahinahon at mapagmahal—huwag makipagtalo.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Makinig nang mabuti—unawain ang kanilang pinanggagalingan.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Gamitin ang Kasulatan—ang Salita ng Diyos ay makapangyarihan.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ipanalangin ang tao—ang Banal na Espiritu ang gumagawa ng pagbabago.',
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
            'content' => '1. Ano ang pinakakaraniwang pagtutol na iyong naririnig?

2. Paano ka tutugon sa pagtutol na iyon gamit ang Bibliya?

3. Manalangin para sa isang tao na may pagtutol sa ebanghelyo.',
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
            'content' => 'Panginoon, bigyan Mo ako ng karunungan at pag-ibig sa tuwing may tumututol sa ebanghelyo.

Tulungan Mo akong maging mahinahon at mabait, at gamitin ang Iyong Salita upang sagutin ang kanilang mga tanong. Nawa ang Banal na Espiritu ang kumilos sa kanilang mga puso.

Ipanalangin ko ang mga taong ito na sana ay mabuksan ang kanilang mga mata sa katotohanan ng ebanghelyo. Sa pangalan ni Hesus, Amen.',
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
            'title' => 'Pag-aakay sa Tao kay Kristo',
            'subtitle' => 'Leading People to Christ',
            'summary' => 'Ang pag-aakay sa tao kay Kristo ay ang pinakamahalagang hakbang sa pag-eebanghelyo. Matutong gabayan ang isang tao sa panalangin ng kaligtasan.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAG-AAKAY SA TAO KAY KRISTO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sinumang sumampalataya sa kanya ay hindi hahatulan, ngunit ang hindi sumampalataya ay nahatulan na, sapagkat hindi siya sumampalataya sa pangalan ng kaisa-isang Anak ng Diyos."',
            'reference' => 'Juan 3:18',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-aakay sa isang tao kay Kristo ay ang kasukdulan ng pag-eebanghelyo. Ito ang sandali kung saan ang isang tao ay gumagawa ng pinakamahalagang desisyon sa kanyang buhay.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA HAKBANG SA PAG-AAKAY SA TAO KAY KRISTO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. TANUNGIN ANG TAO (ASK THE PERSON)',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tanungin ang tao kung nauunawaan niya ang ebanghelyo at kung nais niyang tanggapin si Hesus bilang kanyang Panginoon at Tagapagligtas.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. IPALIWANAG ANG PANALANGIN (EXPLAIN THE PRAYER)',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ipaliwanag na ang panalangin ng kaligtasan ay isang personal na pag-uusap sa Diyos. Hindi ito tungkol sa mga salita kundi tungkol sa katapatan ng puso.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. AKAYIN ANG TAO SA PANALANGIN (LEAD THE PERSON IN PRAYER)',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Akayin ang tao sa panalangin ng pagsisisi at pagtanggap kay Hesus. Maaari mong gamitin ang sumusunod na halimbawa:',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'prayer',
            'content' => '"Panginoong Hesus, ako ay nagkakasala laban sa Iyo. Pinagsisisihan ko ang aking mga kasalanan at tinalikuran ko na ang aking dating pamumuhay. Naniniwala ako na Ikaw ay namatay sa krus upang bayaran ang aking mga kasalanan at muling nabuhay sa ikatlong araw. Pumasok Ka sa aking puso at maging Panginoon ng aking buhay. Gabayan Mo ako at tulungan akong mamuhay para sa Iyo. Sa pangalan ni Hesus, Amen."',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. BIGYAN NG KATIYAKAN (GIVE ASSURANCE)',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pagkatapos ng panalangin, bigyan ang tao ng katiyakan ng kaligtasan batay sa Juan 1:12 at Roma 10:9-10. Tiyakin sa kanila na sila ay tinanggap ng Diyos.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '5. PLANO PARA SA PAGLAGO (PLAN FOR GROWTH)',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tulungan ang bagong mananampalataya na magplano para sa kanyang espirituwal na paglago. Ipakilala siya sa simbahan, sa cell group, at sa mga susunod na hakbang ng kanyang pananampalataya.',
            'sort_order' => 12,
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
            'content' => '1. Magsanay ng panalangin ng kaligtasan kasama ang isang kaibigan.

2. Mag-isip ng isang tao na maaari mong akayin kay Kristo.

3. Manalangin para sa taong iyon at maghanda ng tamang panahon upang makausap siya.',
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
            'content' => 'Panginoon, ginagawa Mo akong instrumento ng Iyong kaligtasan. Bigyan Mo ako ng mga pagkakataon na makaakay ng mga tao sa Iyo.

Tulungan Mo akong maging matapang at mabait sa pag-aakay sa kanila sa panalangin ng kaligtasan. Nawa ang bawat taong aking makausap ay makaranas ng Iyong pag-ibig at kapatawaran.

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
            'title' => 'Pag-aalaga sa mga Bagong Mananampalataya',
            'subtitle' => 'Nurturing New Believers',
            'summary' => 'Ang pag-aalaga sa mga bagong mananampalataya ay mahalaga upang sila ay lumago at magbunga sa kanilang pananampalataya.',
            'image' => 'https://images.unsplash.com/photo-1486299267070-83823f5448dd?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAG-AALAGA SA MGA BAGONG MANANAMPALATAYA',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung paanong ang mga sanggol ay nananabik sa gatas, gayon din kayo, mga bagong mananampalataya, ay manabik sa dalisay na espirituwal na gatas upang kayo ay lumago sa inyong kaligtasan."',
            'reference' => '1 Pedro 2:2',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-aakay sa tao kay Kristo ay hindi katapusan ng proseso. Ito ay simula pa lamang ng kanilang bagong buhay. Kailangan natin silang alagaan at gabayan upang sila ay lumago.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO ALAGAAN ANG MGA BAGONG MANANAMPALATAYA',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. IPAGPATULOY NA IPANALANGIN SILA',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Patuloy na ipanalangin ang mga bagong mananampalataya. Ang panalangin ay nagbibigay ng proteksyon at lakas sa kanilang espirituwal na paglalakbay.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. GAWING DISIPULO SILA',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Turuan sila ng mga pangunahing aral ng pananampalataya. Tulungan silang maunawaan ang Bibliya, panalangin, pagsamba, at pamumuhay bilang Kristiyano.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. ILAWAN ANG KANILANG LANDAS',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maging huwaran sa kanila. Ipakita sa kanila kung paano mamuhay bilang tagasunod ni Hesus sa pamamagitan ng iyong sariling halimbawa.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. ISAMA SILA SA PAMAYANAN',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ipakilala sila sa cell group at sa simbahan. Ang pamayanan ng mga mananampalataya ay mahalaga sa kanilang paglago at pagiging matatag.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '5. BIGYAN SILA NG LAYUNIN',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tulungan silang matuklasan ang kanilang mga kaloob at tawag. Hikayatin silang maglingkod at magbahagi ng kanilang pananampalataya sa iba.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA DAPAT IWASAN SA PAG-AALAGA',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Huwag silang pabayaan—ang mga bagong mananampalataya ay nangangailangan ng gabay.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Huwag silang husgahan—maging mapagpasensya sa kanilang paglago.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Huwag silang pilitin—hayaan silang lumago sa kanilang sariling bilis.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Huwag silang i-pressure—maging gabay at kaibigan sa kanila.',
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
            'content' => '1. Sino ang mga bagong mananampalataya na maaari mong alagaan?

2. Paano mo sila matutulungan na lumago sa kanilang pananampalataya?

3. Ano ang iyong magiging plano upang sila ay maging matatag at magbunga?',
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
            'content' => 'Panginoon, salamat sa mga bagong kapatid na Iyong idinaragdag sa Iyong kaharian. Tulungan Mo akong maging mabuting tagapag-alaga sa kanila.

Bigyan Mo ako ng karunungan at pagtitiyaga upang sila ay gabayan at patatagin sa kanilang pananampalataya. Nawa sila ay lumago at magbunga ng marami pang kaluluwa.

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
            'title' => 'Ang Bunga ng Pag-eebanghelyo',
            'subtitle' => 'The Fruit of Evangelism',
            'summary' => 'Ang pag-eebanghelyo ay nagbubunga ng kagalakan sa langit, pagbabago sa buhay ng mga tao, at kaluwalhatian sa Diyos.',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUNGA NG PAG-EBANGHELYO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sinabi ko sa inyo: \'Ang aanihin ay marami, ngunit kakaunti ang manggagawa.\' Kaya\'t idalangin ninyo sa Panginoon ng aanihin na magpadala siya ng mga manggagawa sa kanyang aanihin."',
            'reference' => 'Lucas 10:2',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-eebanghelyo ay hindi lamang tungkol sa pagtupad ng utos, ito rin ay nagbubunga ng kagalakan, pagbabago, at kaluwalhatian sa Diyos.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA BUNGA NG PAG-EBANGHELYO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. KAGALAKAN SA LANGIT',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sinabi ko sa inyo, magkakaroon ng kagalakan sa harapan ng mga anghel ng Diyos dahil sa isang makasalanang nagsisisi."',
            'reference' => 'Lucas 15:10',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tuwing may isang kaluluwang naliligtas, may kagalakang nagaganap sa langit. Ang ating pagsisikap na mag-eebanghelyo ay nagdudulot ng kagalakan sa puso ng Diyos.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. PAGBABAGO NG BUHAY',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t kung ang sinuman ay na kay Cristo, siya ay bagong nilalang. Ang mga lumang bagay ay lumipas na; narito, ang lahat ay naging bago."',
            'reference' => '2 Corinto 5:17',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ebanghelyo ay may kapangyarihang magbago ng buhay. Ang mga dating nasa kadiliman ay nagiging anak ng liwanag. Ang mga dating walang pag-asa ay nagkakaroon ng bagong pananaw sa buhay.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. KALUWALHATIAN SA DIYOS',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Gayon nawa ang inyong liwanag ay magningning sa harapan ng mga tao, upang makita nila ang inyong mabubuting gawa at luwalhatiin nila ang inyong Ama na nasa langit."',
            'reference' => 'Mateo 5:16',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang bawat kaluluwang naliligtas ay nagdudulot ng kaluwalhatian sa Diyos. Ito ang pinakamataas na layunin ng pag-eebanghelyo—ang luwalhatiin ang Diyos sa pamamagitan ng pagliligtas ng mga kaluluwa.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. PAGLAGO NG IGLESIA',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"At idinagdag ng Panginoon araw-araw sa kanilang bilang ang mga taong inililigtas."',
            'reference' => 'Mga Gawa 2:47',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-eebanghelyo ay nagdudulot ng paglago ng iglesia. Ang mga bagong mananampalataya ay nagiging bahagi ng katawan ni Kristo at nag-aambag sa pagpapalago ng kaharian ng Diyos.',
            'sort_order' => 13,
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
            'content' => '1. Ano ang nag-udyok sa iyo na mag-eebanghelyo?

2. Paano mo ipinagdiriwang ang bawat kaluluwang naliligtas?

3. Ano ang iyong pangarap para sa pagpapalago ng kaharian ng Diyos?',
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
            'content' => 'Panginoon, salamat sa pribilehiyo ng pag-eebanghelyo. Salamat sa bawat kaluluwang naliligtas at sa kagalakan na dulot nito sa Iyong puso.

Patuloy Mo akong gamitin upang maging daan ng Iyong kaligtasan sa marami pang tao. Nawa ang Iyong kaharian ay lumago at ang Iyong pangalan ay luwalhatiin sa buong mundo.

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
            'title' => 'Maging Mabisang Saksi ni Kristo',
            'subtitle' => 'Be an Effective Witness for Christ',
            'summary' => 'Ang pagiging mabisang saksi ni Kristo ay nangangailangan ng buhay na naaayon sa ebanghelyo, pusong puno ng pag-ibig, at kahandaang ibahagi ang pananampalataya.',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'MAGING MABISANG SAKSI NI KRISTO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit tatanggap kayo ng kapangyarihan pagbaba sa inyo ng Banal na Espiritu; at kayo\'y magiging mga saksi ko sa Jerusalem, sa buong Judea at Samaria, at hanggang sa dulo ng mundo."',
            'reference' => 'Mga Gawa 1:8',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging saksi ni Kristo ay hindi lamang isang gawain kundi isang pamumuhay. Bilang mga ipinanganak na muli, tayo ay tinawag upang maging mabisang saksi ng Kanyang pag-ibig at kapangyarihan.',
            'sort_order' => 3,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'KATANGIAN NG ISANG MABISANG SAKSI',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '1. MAY BUHAY NA NAAAYON SA EBANGHELYO',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kayo ang ilaw ng sanlibutan... Nawa\'y magningning ang inyong ilaw sa harapan ng mga tao, upang makita nila ang inyong mabubuting gawa at luwalhatiin ang inyong Ama na nasa langit."',
            'reference' => 'Mateo 5:14-16',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iyong buhay ang unang ebanghelyo na nakikita ng mga tao. Ang pagkakapare-pareho ng iyong salita at gawa ay nagbibigay ng kredibilidad sa iyong patotoo.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '2. MAY PUSONG PUNO NG PAG-IBIG',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sa pamamagitan nito makikilala ng lahat na kayo ay aking mga alagad, kung kayo ay nagmamahalan."',
            'reference' => 'Juan 13:35',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pag-ibig ang pinakamakapangyarihang patunay ng ating pananampalataya. Ang tunay na pag-ibig ay umaakit ng mga tao kay Kristo.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '3. MAY KAHANDAANG MAGBAHAGI',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Maging laging handa kayong sumagot sa sinumang humihingi sa inyo ng dahilan tungkol sa inyong pag-asa."',
            'reference' => '1 Pedro 3:15',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang isang mabisang saksi ay laging handa. Handang magbahagi, handang sumagot, at handang gumamit ng mga pagkakataon upang ipakilala si Hesus.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'subheading',
            'content' => '4. UMAASA SA KAPANGYARIHAN NG ESPIRITU',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit tatanggap kayo ng kapangyarihan pagbaba sa inyo ng Banal na Espiritu."',
            'reference' => 'Mga Gawa 1:8',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi natin kayang gawin ang gawaing ito sa ating sariling lakas. Kailangan natin ang kapangyarihan ng Banal na Espiritu upang maging mabisang saksi ni Kristo.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MGA HAKBANG UPANG MAGING MABISANG SAKSI',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Manalangin araw-araw para sa mga nawawalang kaluluwa.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pag-aralan ang Bibliya upang lalong makilala si Kristo.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Magsanay na ibahagi ang iyong patotoo.',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Gumawa ng mga pagkakataon upang makapag-eebanghelyo.',
            'sort_order' => 18,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Alagaan ang mga bagong mananampalataya.',
            'sort_order' => 19,
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
            'content' => '1. Ano ang mga katangian ng isang mabisang saksi na nais mong malinang sa iyong buhay?

2. Sino ang iyong "Jerusalem" na nais mong maabot?

3. Magtakda ng isang personal na layunin para sa pag-eebanghelyo sa susunod na buwan.',
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
            'content' => 'Panginoon, tinatanggap ko ang Iyong tawag na maging mabisang saksi ni Kristo sa mundong ito.

Punuan Mo ako ng Iyong Banal na Espiritu upang magkaroon ako ng lakas ng loob at karunungan. Nawa ang aking buhay ay maging patunay ng Iyong pag-ibig at kapangyarihan.

Gamitin Mo ako upang maabot ang mga nawawalang kaluluwa hanggang sa dulo ng mundo. Sa pangalan ni Hesus, Amen.',
            'sort_order' => 2,
        ]);
    }
}
