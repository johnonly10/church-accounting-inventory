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

class PepsolLessonSeeder extends Seeder
{
    public function run(): void
    {
        $category = PepsolCategory::where('code', 'B-1')->first();
        $type = PepsolType::where('code', 'SOL 1-A')->first();
        $pepsolName = PepsolName::where('code', 'CON-1')->first();
        $user = User::first();

        $pepsol = Pepsol::create([
            'pepsol_category_id' => $category->id,
            'pepsol_type_id' => $type->id,
            'created_by' => $user->id,
            'description' => 'Comprehensive lessons on salvation, repentance, lordship, forgiveness, lifestyle, devotion, prayer, testimony, obedience, and church life.',
            'guidelines' => 'Study each lesson carefully and reflect on the personal application questions.',
            'orientation' => 'These lessons are designed for new believers to understand the foundational truths of their faith.',
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
            'title' => 'Kaligtasan',
            'subtitle' => 'Salvation',
            'summary' => 'BINABATI KITA!

Isang bagong relasyon ang sinimulan mo kay Hesus.

Isang kaibigan ang nakakita ng iyong pangangailangan at ikaw ay iniugnay sa KALUTASAN – ang Diyos.

Tinanggap mo ang kaloob ng buhay na walang hanggan sa pamamagitan ng pananampalataya kay Kristo. Ang serye ng mga araling ito ay tutulong sa iyo upang higit mong maunawaan kung sino si Hesus, ang mga kayamanang espirituwal, at ang kahanga-hangang buhay na inilaan Niya para sa iyo.
"Ngunit ipinadama ng Diyos ang kanyang pag-ibig sa atin nang mamatay si Cristo para sa atin noong tayo\'y makasalanan pa. Kaya\'t sa pamamagitan ng kanyang dugo, tayo ngayon ay napawalang-sala, at tiyak na maliligtas tayo sa poot ng Diyos. Dati, tayo\'y mga kaaway ng Diyos, ngunit tinanggap na niya tayo bilang mga kaibigan sa pamamagitan ng pagkamatay ng kanyang Anak. At dahil dito, tiyak na maliligtas tayo sapagkat si Cristo ay buhay."

Mga Taga-Roma 5:8–10

"...ito ang aking dugo ng tipan, na nabubuhos dahil sa marami, sa ikapagpapatawad ng mga kasalanan."

Mateo 26:27–29

Ang dugo ni Hesus ay nagbibigay sa atin ng BAGONG BUHAY. Ang pagiging bago ng buhay na ito at ang isang bagong panimula ay hindi natin makakamtan sa ating sarili lamang. Si Kristo lamang ang ating tanging pag-asa sa isang bagong buhay!

At inialay Niya ang Kanyang buhay upang makamtan natin ito..',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'KALIGTASAN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'subheading',
            'content' => 'ANG EBANGHELYO',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Ebanghelyo ay ang **Mabuting Balita**, ang mensahe ng kaligtasan! Ito ang pinakadakilang kapahayagan ng pag-ibig ng Diyos sa sangkatauhan. Ito ang gawain ng pagliligtas sa pamamagitan ng biyaya ng Diyos na naghahatid ng kalayaan sa tao sa pamamagitan ng kapangyarihan ng dugo ng Panginoong Hesus sa krus.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => 'Sinasabi ng Mga Taga-Roma 6:23:',
            'reference' => 'Roma 6:23',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'quote',
            'content' => '"Sapagka\'t ang kabayaran ng kasalanan ay kamatayan; datapuwa\'t ang kaloob na walang bayad ng Dios ay buhay na walang hanggan kay Cristo Jesus na Panginoon natin."',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tumatanggap tayo ng buhay na ito bilang kapalit sa ating mga ginawa, at tinatanggap natin ang talagang nararapat para sa atin. Sapagkat ang lahat ay nagkasala, at walang sinumang nakaabot sa kaluwalhatian ng Diyos (Mga Taga-Roma 3:23); walang matuwid, wala kahit isa (Mga Taga-Roma 3:10).',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Dahil dito, tayong lahat ay karapat-dapat mamatay—hindi lamang sa isang pisikal na kamatayan kundi maging sa pagkahiwalay sa Diyos. Ngunit dahil mahal tayo ng Diyos, binigyan Niya tayo ng isang regalo. Ang regalong ito ay isang bagay na hindi tayo karapat-dapat ngunit ipinagkaloob sa atin dahil sa Kanyang walang pasubaling pag-ibig (unconditional love).',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi natin ito pinaghirapan o kaya\'y kayang paghirapan. Ang regalong ito ay ang buhay na walang hanggan, na ang ibig sabihin ay ang maranasan mo ang buhay na kasama ang Diyos magpakailanman. Ito ay maaaring magsimula ngayon, sa sandaling tanggapin mo si Hesu-Kristo bilang Panginoon at Tagapagligtas ng iyong buhay.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Lahat ng tao ay nangangailangan ng isang Tagapagligtas, sapagkat walang kabuluhan ang buhay kung wala ang Diyos. Kinakailangan nating magbalik-loob sa Tagapagligtas na tunay na nagmamahal sa atin.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Winawasak ng kasalanan ang tao; si Hesus ang Katugunan (Juan 14:6). Si Hesus ang ating kaligtasan. Binayaran Niya nang ganap ang kaparusahan sa krus para sa ating mga kasalanan. Ang Kanyang ginawa sa krus ang nagdala ng katubusan, pagbabago, at pagsasaayos sa ating mga buhay (Mga Gawa 4:12).',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang kaligtasan ay naging posible sa pamamagitan ng ginawang pagtubos ng Panginoong Hesu-Kristo sa krus. Iniligtas Niya tayo mula sa walang hanggang kamatayan na dulot ng ating mga kasalanan. Winasak Niya ang mga sumpa at gawa ng kadiliman sa ating mga buhay.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tinanggap din natin ang bagong buhay kay Kristo (2 Corinto 5:17) at ang pagpapanumbalik ng ating mga buhay sa orihinal na kaluwalhatian at disenyo ng Diyos (Genesis 1:28).',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa pamamagitan ng kapangyarihan ng dugo ni Hesus, tayo ay naipanumbalik. Sa espirituwal, ay naipanumbalik ang ating relasyon o ugnayan sa Diyos. Sa ating mga personal na buhay, ang ating mga relasyon sa tao ay naayos, maging ang ating mga pananalapi ay naayos din.',
            'sort_order' => 13,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAGTUKLAS NG MGA KATOTOHANAN PATUNGKOL SA IYONG BAGONG KAUGNAYAN KAY KRISTO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang mga katotohanan na nasa Biblia ay makatutulong sa iyo upang magkaroon ng isang matibay na pundasyon para sa iyong relasyon kay Kristo.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang mga katotohanang ito ay ang mga sumusunod:',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pinatawad na ni Kristo ang iyong mga kasalanan (Colosas 1:13–14).',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ikaw ay ginawang anak ng Diyos (Juan 1:12). Sa sandaling tanggapin mo si Kristo, ikaw ay nagiging anak ng Diyos.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pumasok si Kristo sa iyong buhay at kailanman ay hindi ka Niya iiwanan (Hebreo 13:5b). Anuman ang mangyari sa iyong buhay o anumang pagsubok ang maaari mong pinagdadaanan, ang Panginoon ay laging nasa iyong tabi upang ikaw ay tulungan.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sinimulan ni Kristo ang isang bagong buhay sa iyo.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t kung nakipag-isa na kay Cristo ang isang tao, isa na siyang bagong nilalang. Wala na ang dati niyang pagkatao, sa halip, ito\'y napalitan na ng bago."',
            'reference' => '2 Corinto 5:17',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iyong lumang kalikasan ay naglaho na habang ikaw ay hinuhubog Niya upang maging katulad ng ninanais Niya para sa iyo.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Panghuli, ikaw ay binigyan Niya ng buhay na walang hanggan.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"At ito ang patotoo: ipinagkaloob sa atin ng Diyos ang buhay na walang hanggan at ito\'y makakamtan natin sa pamamagitan ng kanyang Anak. Ang sinumang pinapanahanan ng Anak ng Diyos ay mayroong buhay na walang hanggan, ngunit ang hindi pinapanahanan ng Anak ng Diyos ay hindi makakaranas ng buhay na walang hanggan. Isinusulat ko ito sa inyo upang malaman ninyo na kayong sumasampalataya sa Anak ng Diyos ay may buhay na walang hanggan."',
            'reference' => '1 Juan 5:11–13',
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
            'content' => 'Kung sasagutin mo ang tanong, "Bakit ka papasok sa langit?" ano ang iyong sasabihin?',
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
            'content' => 'Panginoon, tinanggap ko ang Iyong kaloob na kaligtasan. Kinikilala ko na ako ay isang makasalanan at nangangailangan ng isang Tagapagligtas.

Ako ay nananampalataya na si Hesus ang tanging daan at ang Kanyang dugo ang naglilinis sa akin at nagbibigay ng kalayaan mula sa kasalanan, sumpa, at mga gawa ng kadiliman.

Ipinapahayag ko ngayon ang aking mga kasalanan at aking tinalikuran ang masamang pamumuhay. Aking hinihingi ang Iyong kapatawaran.

Pangunahan Mo ang aking buhay sa araw na ito at magpakailanman.

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
            'title' => 'PAGSISISI',
            'subtitle' => 'Repentance',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAGSISISI',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsisisi ay nagpapahiwatig ng pagbabago ng direksyon, "paglayo sa kasalanan" patungo sa "pagbabago ng kaisipan" upang mamuhay para sa Diyos. Ito ay nagsisimula sa isang pagpapasya na lumayo mula sa kasalanan at isuko ang buhay sa pagiging Panginoon ni Hesu-Kristo. At ito\'y lubhang mahalaga at kinakailangan para sa sinumang nagnanais na lumapit sa Panginoon at lumakad sa Kanya araw-araw.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsisisi ay higit pa sa pagkilala sa mga maling nagawa. Ito ay ang pagbabago ng isip at puso na nagbibigay sa atin ng bagong pananaw patungkol sa Diyos, patungkol sa atin, at patungkol sa sanlibutan. Kasama dito ang pagtalikod sa kasalanan at pagharap sa Diyos para sa kapatawaran. Ito ay inuudyukan ng ating pag-ibig para sa Diyos at ng taos-pusong pagnanasang sumunod sa Kanyang mga utos.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Gayunpaman, ang kasalanan ay hindi katapusan ng kuwento. Sa katunayan, gumagawa ang Diyos sa lahat ng mga pangyayari sa ating mga buhay, kasama na ang ating kasalanan, upang ilapit Niya tayo kay Hesus (Juan 6:44, 45; 14:6; Mga Taga-Roma 8:28, 29).',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Anuman ang iyong nagawa, may ginawa ang Diyos na daan pabalik—sa pamamagitan ng Kanyang Anak na si Hesu-Kristo. Ang Kanyang kamatayan sa krus at ang Kanyang matagumpay na muling pagkabuhay ang nagbibigay sa iyo ng katiyakan para sa lahat ng pagpapala ng Diyos, kasama dito ang kapatawaran.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang natatanging dapat mong gawin ay magsisi at isuko ang iyong buhay kay Hesus (Mga Gawa 3:19). Ito ang tinatawag ng Biblia na "kapanganakang muli" sa Espiritu ng Diyos (Juan 3:3, 5).',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay pumapasok sa karanasan ng kapanganakang muli sa pamamagitan ng pagsisisi sa ating mga kasalanan, pagsusuko ng buhay kay Hesus bilang Tagapagligtas at Panginoon, at magtiwala sa pananampalataya na tayo ay Kanyang patatawarin at lilinisin mula sa lahat ng ating mga kasalanan (Mga Taga-Roma 6:23; 10:13; 1 Juan 1:8, 9; Juan 1:12).',
            'sort_order' => 7,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MAGKAROON NG PANANAMPALATAYA SA PAGSISISI!',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung ikaw ay nahihirapan sa kasalanan na tumatali sa iyo, ang pagsisisi ay tila isang napakahirap na bagay para sa iyo. Isaalang-alang na sinasabi ng Biblia, "ang kabutihan ng Dios ay siyang umaakay sa iyo sa pagsisisi" (Mga Taga-Roma 2:4). May isa pang talata na nagsasabi sa atin na ang Diyos ay matiyagang naghihintay sa atin upang tayo ay magsisi (2 Pedro 3:9).',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iyong Ama sa langit ay hindi naghahanap ng mga paraan upang ikaw ay parusahan. Oo, ang Diyos ay matuwid, subalit Siya din ay isang mapagmahal na Ama na naghahanap sa nawawalang salapi o ang nawawalang isang tupa—na nakahandang iwan ang 99 sa ligtas na pastulan upang hanapin ang nag-iisa ngunit nawawalang tupa.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Isa sa pinakamakapangyarihang paglalarawan ng pag-ibig ng Diyos ay makikita sa talinhaga ng alibughang anak. Matapos na magbago ng isip ang anak at nagsimulang umuwi, sinasabi ng Biblia, "Malayo pa\'y natanaw na siya ng kanyang ama, at dahil sa matinding awa ay patakbo siyang sinalubong, niyakap, at hinalikan." (Lucas 15:20).',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ito ang puso ng Diyos para sa iyo sa sandaling lumapit ka sa Kanya sa pagsisisi.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Habang ikaw ay nananalangin, ang Diyos ay buong tiyagang naghihintay na may bukas na kamay para sa pagbabalik ng Kanyang mga anak na lalaki at babae. Ang tanging kailangan lamang sa ating bahagi ay ang pagpapakumbaba at ang pananampalataya na maniwala na maririnig ng mapagmahal na Ama ang ating mga tapat na hinaing at tayo ay Kanyang lilinisin mula sa ating kasalanan.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Gamitin ang sandaling ito upang ikaw ay magsisi ngayon—na baguhin ang iyong kaisipan at talikuran ang anumang bagay na naghihiwalay sa iyo mula sa Diyos at sa mga tao sa iyong paligid.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'prayer',
            'content' => '"Ama, ako ay nanampalataya na ako ay mahal Mo. Sinasabi ng Iyong Salita, na ang Iyong pagtitiyaga at kabaitan ang siyang umaakay sa akin sa pagsisisi. Kung kaya\'t ako ay buong pagpapakumbaba na lumalapit sa Iyo at ipinapahayag ang aking mga kasalanan. Pinapasalamatan kita sa Iyong pagpapatawad at paglilinis sa aking katawan, kaluluwa at espiritu. Sa pamamagitan ng dugo ni Hesus, turuan Mo akong lumakad nang may katapatan at katuwiran sa Iyong harapan araw-araw. Sa pangalan ni Hesus, Amen."',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kinakailangan nating magtiwala kay Hesu-Kristo na Kanyang patatawarin ang ating mga kasalanan at maging matibay sa pagpapasyang sumunod sa Kanya sa ating buong buhay. Sa gayon, makikilala natin ang Diyos at muling maranasan ang kapayapaan.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Sinasabi ng Biblia, "Kung ipahahayag ng iyong labi na si Jesus ay Panginoon at buong puso kang sasampalataya na siya\'y muling binuhay ng Diyos, maliligtas ka. Tatanggapin at ililigtas ka ng Diyos kung tunay mo itong pananampalatayanan."',
            'reference' => 'Mga Taga-Roma 10:9',
            'sort_order' => 10,
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
            'content' => 'Alamin ang mga natatagong kasalanan na kumokontrol sa iyong buhay at naglalayo sa iyo sa Diyos. Magsisi at hingin sa Panginoon ang Kanyang kapatawaran upang ikaw ay magkaroon ng bagong simula.

Hindi mahalaga kung tayo ay nagkamali sa nakaraan; maaari tayong makapagsimula ulit anumang sandali. Anong pangako o pagtatalaga ang hinihintay ng Diyos na iyong gawin sa Kanya ngayon?

Mag-isip ng anuman—kaisipan, sitwasyon, o mga gawain na maaaring maging hadlang sa iyong pakikipagrelasyon sa Diyos.

Sa pamamagitan ng panalangin, ipahayag mo na si Hesus lamang ang tanging daan sa Diyos at mangako na ikaw ay mamumuhay para sa Kanya habang ikaw ay nabubuhay. Iwaksi ang kasalanan at wasakin ang bawat sumpa sa pangalan ni Hesu-Kristo.',
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
            'content' => 'Panginoon, kami po ay nananampalataya na Ikaw ang matuwid at kami ang nagkamali. Nagsisisi ako sa mga bagay na aking nagawa.

Sa pamamagitan ng Iyong biyaya at pag-ibig, ako ay nagsisisi at magbabago ng aking buhay. Ipamumuhay ko ang katotohanan mula sa Iyong mga Salita, ang Biblia.

Sa pangalan ni Hesus, Amen.',
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
            'title' => 'Pagiging Panginoon',
            'subtitle' => 'Lordship',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PAGIGING PANGINOON',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Panginoon, ... Nasa inyo ang mga salitang nagbibigay ng buhay na walang hanggan. Naniniwala kami at ngayo\'y natitiyak namin na kayo nga ang Banal na mula sa Diyos."',
            'reference' => 'Juan 6:68–69',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANO ANG TUNAY NA KAHULUGAN NG PAGIGING PANGINOON NI KRISTO?',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging Panginoon ni Kristo ay nangangahulugan ng pagbabalik ng "kaayusan" sa ating pakikipag-ugnayan sa Diyos. Ang kahulugan nito ay ang pagkilala na Siya ang "Panginoon" sa ating buhay, sapagkat kung tayo ay hiwalay sa Kanya, wala tayong magagawa.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nananampalataya tayo na Siya ang Kataas-taasan at Makapangyarihang Diyos (Isaias 40:28), na Siya ang lumikha sa atin at Siya ang Hari sa ating mga buhay.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Isang bagay na makilala si Kristo bilang Tagapagligtas, at isang bagay na kilalanin Siya bilang Pinakamataas. Sinasabi ng Mga Gawa 2:36 na si Hesus ay "parehong Panginoon at Messias (Tagapagligtas)!"',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sinasabi nito sa atin na ginawa ng Diyos si Hesus na parehong Panginoon at Kristo. Itinuturo ng talatang ito na Siya ay naparito hindi lamang upang wasakin ang kasamaan ng kasalanan, na Kanya namang tiyak na ginawa.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Si Hesus ang Messias na isinugo upang iligtas tayo sa ating laman, ang ating makasalanang kalikasan, at ang ating panloob na pagnanasa sa kasalanan. Ngunit Siya ay naparito para sa higit pang personal na pakikipag-ugnayan. Siya ay naparito rin upang maging ating Panginoon.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang kahulugan ng "Panginoon" ay tagapagmay-ari, maestro. Ipinadala ng ating Manlilikha ang Kanyang Anak hindi lamang upang tubusin ang Kanyang nilikha, kundi upang muling angkinin bilang may-ari. Siya ay naparito upang maging ating Panginoon sa bawat bahagi ng ating mga buhay.',
            'sort_order' => 9,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANO ANG MGA KABUTIHANG DULOT NG PAGPAPAILALIM SA PAGKA-PANGINOON NI KRISTO?',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Una, tayo ay nananagana sapagkat Siya ang ating Tagapakaloob (Provider). Tumatanggap tayo ng pag-iingat, at walang anumang kasamaan ang mangyayari sa atin.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay tumatanggap ng pag-asa sapagkat Siya ang Diyos ng pag-asa (Mga Taga-Roma 15:13), at panghuli, tayo ay tumanggap ng mabuting kinabukasan (Jeremias 29:11).',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'GAWING PANGINOON SI JESUS NG ATING MGA BUHAY',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging Panginoon ni Hesus sa ating buhay ay nakatutulong sa ating mabago ang ating kaisipan upang ating makita na si Hesus ay gumagawa sa atin, sa ibang tao, at sa sanlibutan.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Si Hesus ay higit na dakila sa lahat ng bagay! Ang Kanyang Pangalan, ang Kanyang ginagampanan, ang Kanyang panukala, at ang Kanyang layunin ay higit na mataas sa lahat ng bagay.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging Panginoon ni Hesus at ang pamumuhay na banal ay hindi ipinagpipilitan sa atin. Hindi natin sinasang-ayunan o pinangangatawanan ang isang relihiyon lamang, bagkus ay isang pakikipag-ugnayan sa ating Panginoon!',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang banal na pamumuhay ay bunga ng isang buhay na nabago sa pamamagitan ng ginawa ni Kristo para sa atin.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi tayo lalago sa pananampalataya sa pamamagitan ng pagparusa sa ating mga sarili, o sa pamamagitan ng pagtuklas sa mga lihim na kaalaman o mga natatanging kapahayagan; sa halip, tayo ay lumalago sa pananampalataya sa pamamagitan ng pagkilala, pagtitiwala, at pagsunod kay Kristo bilang PANGINOON, na ating nakilala kung sino Siya at kung ano ang Kanyang ginawa para sa atin, at tayo ay tumugon sa pamamagitan ng ating pasasalamat, pagtitiwala, at pagsunod.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa pamamagitan ng pagpaparangal sa pagiging Panginoon ni Hesus sa ating buhay ay higit nating mararanasan ang kapangyarihan upang matagumpay at buong kahusayan na mamuhay para sa Kanya.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay kumikilos bilang mga anak ng Diyos, habang tayo ay patuloy na binabago ayon sa wangis ni Kristo. Tayo ay may Diyos na nabubuhay sa atin, pumapatnubay, nangunguna, nagpapalakas, at pumupuno sa atin.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Isipin kung ano ang magagawa ng Diyos sa iyo at sa iyong iglesia. Kung tunay tayong magtitiwala kay Kristo, hindi lamang bilang Tagapagligtas kundi bilang PANGINOON din naman, tayo ay pinagkakalooban ng kapangyarihan at kakayahan upang magkaroon ng isang buhay na ganap, isang buhay na naiiba, at espirituwal na kalaguan upang Siya ay maluwalhati sa ating mga buhay!',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ating tugon sa pagka-Panginoon ni Hesus ay, **"Opo, Panginoon!" (Yes, Lord!)** Ito ang ating pagpapatunay ng ating pagtatalaga, pagtitiwala, at pagsunod.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Siya ay nagtiis at naghirap para sa atin. Siya\'y nagtungo sa krus para sa ating lahat. At dahil dito, tayo ay sumusunod sa Kanyang mga yapak.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay pinagaling at iniligtas Niya; dahil dito, kailangan nating magtiwala at hayaan Siyang maging Pastol, Gabay, at Panginoon ng lahat.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagiging Panginoon ni Kristo ay isang katotohanan; ito ay mahalaga, at kinakailangan tayong tumugon nang buong-puso!',
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
            'content' => 'Ikaw ba ay isang Kristiyanong nasa isang pakikipag-ugnayan ngayon na lubos mong ipinapailalim sa pagiging Panginoon ni Hesus?

Sino si Hesu-Kristo sa iyo? Sino ka sa Kanya?

Sa pamamagitan ng panalangin, ipahayag mo na si Hesu-Kristo ang tanging Panginoon ng iyong buhay at sa lahat ng bahagi nito. Italaga na ikaw ay buong buhay na mamumuhay para sa Kanya.',
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
            'content' => 'Ama, salamat sa Iyo sa palaging pagnanais na maranasan ko ang pinakamainam, at sa pagtawag Mo sa akin hindi lamang upang magkaroon ng relasyon sa Iyo kundi upang Ikaw ay gawing Panginoon din ng aking buhay.

Ako ay nangangakong susunod sa Iyo at magsisikap upang ayusin ang lahat ng bahagi ng aking buhay. Ibigay Mo sa akin ang marubdob na pagnanasa at pagtitiyaga upang maging Iyong alagad at hindi sumuko sa buhay anuman ang mangyari.

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
            'title' => 'Kapatawaran',
            'subtitle' => 'Forgiveness',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1509017174183-0b7e0278b6e5?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'KAPATAWARAN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sapagkat kung pinapatawad ninyo ang mga nagkakasala sa inyo, patatawarin din kayo ng inyong Ama na nasa langit. Ngunit kung hindi ninyo pinapatawad ang iba, hindi rin naman patatawarin ng inyong Ama ang inyong mga kasalanan."',
            'reference' => 'Mateo 6:14–15',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Bibigyan ko kayo ng bagong puso at bagong espiritu. Ang masuwayin ninyong puso ay gagawin kong pusong masunurin."',
            'reference' => 'Ezekiel 36:26',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Marahil ang unang tao na hindi mo pa napapatawad ay ang iyong sarili. Maraming tao ang may kakulangan ng pagpapatawad sa kanilang sarili kaysa sa iba. Hindi nila handang patawarin ang sarili at kilalanin na sinasabi ng Diyos, "Kung gaano kalayo ang silangan sa kanluran, gayon din niya inalis sa atin ang ating mga kasalanan." (Mga Awit 103:12).',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung ikaw ay isang mananampalataya, ikaw ay Kanya nang nilinis upang ikaw ay makapaglingkod sa buhay na Diyos. Hindi tayo iniwan ng Diyos na may sala o karumihan pa sa lumipas na kasalanan. Ito ay dapat nang patay, nalibing, at nakalimutan.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kinakailangang patawarin ng tao ang lahat ng nangangailangan ng kapatawaran. Kung ang unang tao na nangangailangan ng kapatawaran ay ang sarili mo, kailangan mong sabihin, "Diyos, sa Iyong harapan ay aking pinatatawad ang aking sarili. Anuman ang aking nagawa, tinanggap ko ang Iyong kapatawaran, at pinapatawad ko rin ang aking sarili."',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ito ay napakasimple ngunit lubhang malalim na pananalita, sapagkat hangga\'t nararamdaman natin na tayo ay nasa ilalim ng kahatulan, hindi tayo magkakaroon ng pananampalataya na makita ang mga himala at dakilang pagbabago.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Mga minamahal, kung hindi tayo inuusig ng ating budhi," ang sabi ng Biblia, "makakalapit tayo sa Diyos na panatag ang ating kalooban."',
            'reference' => '1 Juan 3:21',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maliwanag na hindi tayo maaaring magkaroon ng nagpapatuloy na kasalanan sa ating buhay at umasa ng kapatawaran. Kinakailangan na tayo ay malaya na sa anumang nagpapatuloy at sinasadyang kasalanan at paghihimagsik laban sa Diyos.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'May mga taong sinisisi ang Diyos dahil sa anak na namatay, naglayas na asawa, kung sila ay nagkasakit, walang sapat na salapi o anumang katulad nito. Sinasadya man o hindi, iniisip nila na ang lahat ng ito ay pagkakamali ng Diyos.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'May mga sama ng loob na malalim nang nakatanim; gayunpaman, hindi maaaring ikaw ay may galit o sama ng loob sa Diyos at kasabay nito ay umaasa na makakaranas ng mga himala ng Diyos. Kailangan mong linisin ang sarili sa lahat ng kapaitan mo sa Diyos.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Dapat mong tanungin ang iyong sarili, "Sinisisi ko ba ang Diyos sa aking kalagayan?"',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ikalawang tao na dapat mong patawarin ay miyembro ng iyong pamilya. Kailangang alisin mo ang lahat ng galit o sama ng loob, lalo na sa mga taong pinakamalapit sa iyo.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang mga asawang lalaki, mga asawang babae, mga anak, mga magulang at iba pang kamag-anak—lahat ay dapat na patawarin kapag nabuo ang galit o sama ng loob sa pamilya.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Marami ang nagsasabi, "Hindi ko alam na pati pala iyon ay kasama. Ang akala ko iyon ay karaniwan at isang bagay na pampamilya."',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Lahat ng kakulangan ng pagpapatawad ay dapat na alisin, lalo na tungo sa bawat miyembro ng pamilya.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Panghuli, dapat na may kapatawaran para sa kaninuman na may nagawang masama laban sa iyo. Maaaring isang napakasamang bagay ang nagawa ng taong iyon sa iyo. Maaaring ikaw ay may legal o intelektuwal na karapatan upang magtanim ng sama ng loob at kasuklaman ang taong iyon.',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Subalit kung nais mong makakita ng mga himala sa iyong buhay, walang pasubaling kinakailangang ikaw ay magpatawad.',
            'sort_order' => 18,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Patawarin mo sila hanggang sa punto na talagang nararamdaman mo na ikaw ay nalinis na sa lahat ng galit o sama ng loob at kapaitan at ngayon ikaw ay nananalangin para sa kanila.',
            'sort_order' => 19,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ISANG BAGONG SIMULA UPANG MAGPAWAD!',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maraming tao ang naikulong na ng pusong ayaw magpatawad. Maaaring dala-dala nila ito ng napakatagal na panahon na hindi na nila napapansin na ito ay lubhang nakaaapekto sa kanilang mga pagpapasya sa buhay.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maaaring hindi madali ang magpatawad, lalo na kung ang mga taong nakasakit sa iyo ay ang mga taong pinakamalapit sa puso mo. Subalit hindi nais ng Diyos na ang Kanyang mga anak ay magkaroon ng mga kapaitan at maging pusong-bato.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Siya ay nag-aalok ng bagong simula sa bawat isa at kasama dito ang patawarin at magkaroon din naman ng kakayahang magpatawad.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Inilarawan ni Hesus ang pinakamainam na halimbawa ng pagpapatawad nang Siya ay ipinako at tinuya ng mga tao. Ipinakita pa rin Niya ang Kanyang dakilang kahabagan nang Siya ay nanalangin,',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ama, patawarin Mo sila sapagkat hindi nila nalalaman ang kanilang ginagawa."',
            'reference' => 'Lucas 23:34',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANO BA ANG ISANG BUHAY NA MAY BAGONG SIMULA KAY KRISTO?',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ay ang pagpapanumbalik ng iyong relasyon.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ay walang kinikimkim na galit o kapaitan.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ito ay hindi nanghuhusga at humahatol.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang isang bagong simula ay panawagan sa kalayaan ng pamumuhay na may binago at dinalisay na puso. Tayo ay palaging may pagkakataon upang magkaroon ng pasimula sa buhay hindi dahil tayo ay karapat-dapat para dito, kundi dahil sa biyaya ng Diyos (Efeso 1:7) at dahil sa Kanyang pag-ibig sa atin.',
            'sort_order' => 11,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PRACTICAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => 'Kilalanin o alamin ang mga taong nakasakit sa iyo at ipanalangin na linisin ka ng Diyos at mabuksan ang iyong puso upang patawarin at tanggapin ang mga taong ito sa iyong buhay.',
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
            'content' => 'Salamat sa pagpapatawad Mo sa aking mga kasalanan at sa pagiging ganap na halimbawa ng pagpapatawad at pag-ibig nang Ikaw ay ipinako sa krus.

Hinihingi ko ang lakas at ang habag upang patawarin ang mga taong nakasakit sa akin. Inaalis ko ang kapaitan, pagkasuklam, galit, at alitan, at aking hinahayaan na puspusin Mo ang aking puso ng Iyong pag-ibig at kahabagan.

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
            'title' => 'Pamumuhay',
            'subtitle' => 'Ang 4 na Pinakadakilang Pagtitipon Lifestyle – The 4 Greatest Meetings',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PAMUMUHAY: ANG 4 NA PINAKADAKILANG PAGTITIPON',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Huwag nating kaliligtaan ang pagdalo sa ating mga pagtitipon, gaya ng ginagawa ng ilan. Sa halip, palakasin natin ang loob ng isa\'t isa, lalo na ngayong nakikita nating malapit na ang araw ng Panginoon."',
            'reference' => 'Mga Taga-Hebreo 10:25',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang tagumpay ay nakasalalay sa kung paano natin ipinamumuhay ang ating mga buhay. Nagbibigay tayo ng panahon sa mga bagay na mahalaga sa atin. Dahil dito, habang ikaw ay nagpapatuloy sa iyong bagong relasyon sa Diyos, kakailanganin mo ang lakas, suporta, mga kaibigan, at pagpapalakas ng loob.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa pasimula pa lang, may isang bagay ang dapat mong kilalanin, na hindi natin kayang gawin ang mga bagay sa ating sarili lamang. Ipinagkaloob na ng Diyos ang lahat ng ating mga magiging kailangan upang magpatuloy sa paglago sa ating pakikipagrelasyon sa Kanya.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kasama na dito ang ating "bagong uri ng pamumuhay," na kailangan ng bawat Kristiyano sa kanilang paglakad sa Diyos upang magpatuloy sa paglago.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ito ang mga pangunahing bagay na dapat nating isama at italaga sa ating mga buhay:',
            'sort_order' => 6,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => '1. DEVOTION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iyong devotion ay ang iyong pang-araw-araw na pakikipag-ugnayan sa Salita ng Diyos. Ang Kanyang Salita ang pinagmumulan ng ating pananampalataya at pag-asa. Ang pag-angkin sa mga pangako ng Diyos para sa iyong buhay araw-araw ay magpapalakas sa iyong paglakad sa Kanya.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Huwag mong kaliligtaang basahin ang aklat ng kautusan. Pagbulay-bulayan mo iyon araw at gabi upang matupad mo ang lahat ng nakasaad doon. Sa ganoon, magiging masagana at matagumpay ang iyong pamumuhay. Tandaan mo ang bilin ko: Magpakatatag ka at lakasan mo ang iyong loob. Huwag kang matatakot o mawawalan ng pag-asa sapagkat akong si Yahweh, na iyong Diyos, ay kasama mo saan ka man magpunta."',
            'reference' => 'Josue 1:8–9',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => '2. CELL GROUP',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kailangan natin ang mga taong magkakaroon ng pananagutan sa atin at nakatalaga upang palabasin ang pinakamainam sa atin.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Sikapin din nating gisingin ang damdamin ng bawat isa sa pagmamahal sa kapwa at sa paggawa ng mabuti. Huwag nating kaliligtaan ang pagdalo sa ating mga pagtitipon, gaya ng ginagawa ng ilan. Sa halip, palakasin natin ang loob ng isa\'t isa, lalo na ngayong nakikita nating malapit na ang araw ng Panginoon."',
            'reference' => 'Mga Hebreo 10:24–25',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Gospel Community na ito ay kaaya-aya at nababagay na lugar para sa paglago, pag-unlad, at tagumpay sa ating relasyon sa Diyos at sa ibang tao.',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => '3. SUNDAY CELEBRATION',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'May dalawang uri ng pagtitipon: maliban pa sa cell group, mayroon pang isang malaking pagtitipon kung saan tayo sumasamba bilang isang pamilyang espirituwal at tumatanggap ng Salita ng Diyos.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang Cell Celebration ay ang malaking pagtitipon kung saan ang lahat ng mga cell groups ay nagkikita.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Basahin ang Mga Gawa 2:42–47.',
            'reference' => 'Mga Gawa 2:42–47',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => '4. PEPSOL / LIFE CLASS EQUIPPING AND TRAINING',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kakailanganin mo rin na ikaw ay sanayin upang gawin ang mga bagay na ipinagkatiwala ng Diyos sa iyo.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsasanay sa PEPSOL (Pre-Encounter, Encounter, Post-Encounter, and School of Leaders) ay maaaring pagmulan ng iyong pag-unlad at paglago, kung saan matututunan mong ilabas at pakawalan ang mga kakayahang inilagay ng Diyos sa iyo upang makalikha ka ng magandang epekto sa buhay ng iba.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang mga narinig mo sa akin sa harap ng maraming saksi ay ituro mo rin sa mga taong mapagkakatiwalaan at may kakayahang magturo naman sa iba."',
            'reference' => '2 Timoteo 2:2',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa iyong mga pagsasanay, manabik na pagkatiwalaan ang mga katotohanang nais ng Diyos na iyong mapakinggan, maangkin, at maipamuhay.',
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
            'content' => 'Magkaroon ng isang "lifestyle check" at maging tiyak na ihanay ang iyong pamumuhay sa layunin at plano ng Diyos.

Alamin kung alin dito ang dapat mong isama o higit pang italaga sa iyong pamumuhay upang magpatuloy sa paglago sa iyong paglakad sa Diyos.',
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
            'content' => 'Salamat, Hesus, sa pagtawag Mo sa akin upang lumakad sa isang relasyon sa Iyo at sa Iyong mga anak.

Bigyan Mo ako ng kaalaman upang aking maalagaan at mabantayan ang aking relasyon sa Iyo at sa aking pamilyang espirituwal.

Tulungan Mo ako na aking magawa at maitalaga ang aking sarili sa araw-araw na personal devotion, Gospel Community (Cell Group), Sunday Cell Celebration, at pagsasanay upang maging katulad ng nais Mo para sa akin.

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
            'title' => 'Ang Buhay Debosyonal',
            'subtitle' => 'Devotional Life',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG BUHAY DEBOSYONAL',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Subalit inutusan ko silang sumunod sa akin upang sila\'y maging aking bayan at ako naman ang kanilang magiging Diyos. Sinabi kong mamuhay sila ayon sa ipinag-uutos ko, at magiging maayos ang kanilang buhay."',
            'reference' => 'Jeremias 7:23',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nagnanais ang Diyos na Siya ay maging bahagi ng ating araw-araw na buhay. Siya ay nananabik na maipakita ang Kanyang pag-ibig sa atin sa mga tanging paraan.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang isang Kristiyano at isang tagasunod ni Hesus, kinakailangan nating magkaroon ng quality time araw-araw sa Panginoon. Ang devotion (o quiet time) ay hindi lamang nagtatapos sa pagsusulat sa ating devotional notebook.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nais ng Diyos na magkaroon tayo ng hindi natatapos na devotion—isang uri ng devotion na hindi lamang nalilimitahan sa isang oras o araw sa ating buhay, bagkus isang devotion na higit o lampas pa sa oras, lugar, o mga kalagayan ng buhay.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Huwag mong kaliligtaang basahin ang aklat ng kautusan. Pagbulay-bulayan mo iyon araw at gabi upang matupad mo ang lahat ng nakasaad doon. Sa ganoon, magiging masagana at matagumpay ang iyong pamumuhay."',
            'reference' => 'Josue 1:8',
            'sort_order' => 6,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG LAYUNIN NG DEVOTIONS',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ginagawa natin ang ating mga devotion upang magkaroon tayo ng malapit at malalim na relasyon sa Diyos. Ninanais ng Ama ang ating araw-araw na pagsamba, at Siya ay nalulugod na tayo ay naglalaan ng oras sa pagbubulay-bulay sa Kanyang mga Salita.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nais ng Diyos na higit pa natin Siyang makilala. Habang nakikilala natin Siya sa mga aralin ng buhay, tayo ay inihahanda at binibigyan ng kakayahan upang higit na maging katulad Niya.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO IHANDA ANG IYONG DEVOTIONS',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maglaan ng oras at maging tuloy-tuloy (consistent) dito. Gawin ito sa umaga bago simulan ang iyong araw at sa gabi, bago naman ito magtapos. (Josue 1:8)',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Sa pagbabasa ng Salita ng Diyos, lumayo sa mga pinagmumulan ng gambala (i.e., computer, cellphone, TV, atbp.).',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Makinig sa Diyos sa Kanyang pangungusap sa pamamagitan ng Kanyang Salita sa Biblia. (Mga Awit 46:10; Job 2:13)',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Hingin ang patnubay ng Banal na Espiritu at maging handa na sumunod sa mga bagay na Kanyang pinatotohanan sa Kanyang Salita. (Juan 2:5)',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Lumapit sa Kanya na may pusong nagpapakumbaba at tainga na nakikinig. (Mga Awit 51:17)',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Upang magawa mo nang tama ang iyong mga devotion, kinakailangang ikaw ay may Biblia. Piliin ang salin na iyong higit na nakasanayan.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kinakailangang ikaw ay may notebook at ballpen para sa pagsusulat. Pagkatapos mong magbasa, maaari mong isulat ang mga sumusunod:',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'RHEMA – ito ang tiyak (specific) na Salita ng Diyos para sa iyo sa sandaling iyon.',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'REFLECTION – maaari mong laliman ang pagbubulay-bulay sa Rhema ng Salita ng Diyos para sa iyo at iugnay ito sa iyong mga kalagayan o pangyayari sa buhay.',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'MOTIVATION – ang Salita ng Diyos ay puno ng mga panghihikayat (motivations) at mga pangako na maaari mong angkinin.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'APPLICATION – ang devotion ay hindi devotion kung walang pagsasabuhay (application). Tiyakin na ikaw ay may gagawin pagkatapos na iyong tanggapin ang kapahayagan mula sa Diyos.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maaari ka ring gumawa ng talaan ng iyong mga kahilingan sa panalangin.',
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
            'content' => 'Maging mangingibig ng Salita ng Diyos at ipasakop ang iyong buhay sa kapamahalaan (final authority) nito.

Ipanalangin ang iyong mga mithiin sa araw at sa buhay upang iyong malaman ang nais ipagawa ng Diyos sa iyo.

Gawin mong layunin na magawa ang iyong devotion nang tuloy-tuloy sa linggong ito.

Magkaroon ng talaan ng iyong mga kahilingan sa panalangin at ihanay ang mga ito sa Salita ng Diyos upang makamit ang Kanyang pangunguna.',
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
            'content' => 'Panginoon, salamat sa pagkakaloob Mo sa akin ng Iyong mga Salita upang ako\'y patnubayan araw-araw at upang ako ay patuloy na palaguin.

Ako\'y nagagalak sa Iyong mga daan; tulungan Mo ako na maipamuhay ang Iyong Salita at magpasakop sa kapamahalaan nito sa aking buhay.

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
            'title' => 'Ang Iyong Masigasig na Buhay Panalangin',
            'subtitle' => 'Your Active Life of Prayer',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'ANG IYONG MASIGASIG NA BUHAY PANALANGIN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'PANALANGIN',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay ang iyong pakikipag-usap at pakikipag-isa sa Diyos. Ito ang pinakamalapit at pinakamatalik (intimate) na sandali na maaari mong maranasan sa Diyos.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa panalangin, ang kalaliman ng iyong espiritu ay nasa pakikipag-usap at pakikipag-isa sa mga kalaliman ng Espiritu ng Diyos. Maaaring magmula dito ang mga pagtuturo, patnubay, o kaya\'y isang pasanin na ipanalangin ang ilang mga bagay.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang mga pagtuturo ng Diyos ay malinaw kung paano tayo mananalangin, sino ang ipapanalangin, kailan mananalangin, saan mananalangin, at ano ang iyong dapat na ipanalangin. Ang Biblia ay nagbibigay ng mga tiyak (specific) na utos para sa lahat ng ito at higit pa.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nilikha ng Diyos ang tao upang makipag-ugnayan (fellowship) sa Kanya at ang pang-araw-araw na pananalangin ay mahalaga sa ugnayang ito. Manalangin sa Ama (Lucas 11:2) sa pangalan ni Hesu-Kristo (Juan 14:13–14) sa pamamagitan ng kapangyarihan ng Banal na Espiritu (Efeso 6:18).',
            'sort_order' => 6,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO MANALANGIN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Humingi kayo at kayo\'y bibigyan; humanap kayo at kayo\'y makakatagpo; kumatok kayo at kayo\'y pagbubuksan. Sapagkat ang bawat humihingi ay tatanggap; ang bawat humahanap ay makakatagpo; at ang bawat kumakatok ay pagbubuksan."',
            'reference' => 'Mateo 7:7–8',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung nananatili kayo sa akin at nananatili sa inyo ang aking mga salita, hingin ninyo ang anumang nais ninyo at ibibigay iyon sa inyo."',
            'reference' => 'Juan 15:7',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'KAILAN MANANALANGIN',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Manalangin nang tuloy-tuloy (Mga Taga-Roma 12:12; 1 Tesalonica 5:17).',
            'reference' => 'Mga Taga-Roma 12:12; 1 Tesalonica 5:17',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Tuwing ipapanalangin namin kayo, lagi kaming nagpapasalamat sa Diyos na Ama ng ating Panginoong Jesu-Cristo."',
            'reference' => 'Mga Taga-Colosas 1:3',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'SINO ANG IPAPANALANGIN',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Una sa lahat, ipinapakiusap kong idulog ninyo sa Diyos ang inyong mga kahilingan, panalangin, pagsamo, at pasasalamat para sa lahat ng tao."',
            'reference' => '1 Timoteo 2:1',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit ito naman ang sinasabi ko, ibigin ninyo ang inyong mga kaaway at ipanalangin ninyo ang mga umuusig sa inyo."',
            'reference' => 'Mateo 5:44',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'SAAN MANANALANGIN',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ngunit kapag mananalangin ka, pumasok ka sa iyong silid at isara mo ang pinto. Saka ka manalangin sa iyong Ama na hindi mo nakikita, at ang iyong Ama na nakakakita ng ginagawa mo sa lihim ang siyang magbibigay sa iyo ng gantimpala."',
            'reference' => 'Mateo 6:6',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Madaling-araw pa\'y bumangon na si Jesus at nagpunta sa isang lugar kung saan maaari siyang manalanging mag-isa."',
            'reference' => 'Marcos 1:35',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANO ANG IPAPANALANGIN',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Anumang hingin ninyo sa panalangin ay tatanggapin ninyo kung nananalig kayo."',
            'reference' => 'Mateo 21:22',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Gayundin naman, tinutulungan tayo ng Espiritu sa ating kahinaan. Hindi tayo marunong manalangin nang wasto, kaya\'t ang Espiritu ang dumaraing para sa atin, sa paraang di natin kayang sambitin."',
            'reference' => 'Mga Taga-Roma 8:26',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Nais ng Diyos na makapakinig Siya mula sa atin. Inaasahan Niya na tayo ay darating at magagalak sa bawat minuto na sa Kanya lamang natin ibinibigay.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay ang araw-araw na karanasan sa Diyos. Ito ang susi sa paglago ng ating relasyon ng pag-ibig sa Diyos, sa paghahayag ng kahulugan ng Kasulatan at pag-aakay sa ating buhay sa pagsunod sa Diyos.',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay ang pag-aalay ng lahat ng ating mga naisin sa Diyos nang may mapagpakumbabang katiyakan na tatanggapin natin ang kahabagan sa pamamagitan ni Hesu-Kristo na ating Panginoon.',
            'sort_order' => 18,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t huwag tayong mag-atubiling lumapit sa trono ng mahabaging Diyos upang makamtan natin ang habag at kalinga sa panahon ng ating pangangailangan."',
            'reference' => 'Mga Hebreo 4:16',
            'sort_order' => 19,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ikaw ay anak ng Diyos. Huwag matakot na lapitan Siya nang may kapanatagan dala ang mga naisin ng iyong puso.',
            'sort_order' => 20,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAANO MANALANGIN',
            'sort_order' => 21,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Marami tayong maaaring matutunan mula sa Panalangin ng Panginoon (the Lord\'s Prayer), ang huwaran sa panalangin. Basahin ang Mateo 6:9–13.',
            'sort_order' => 22,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang unang bagay kung tayo ay mananalangin ay kailangan nating simulan sa pagkilala sa kung SINO ang ating kinakausap—ang Diyos, ang AMA natin.',
            'sort_order' => 23,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kinakailangan din nating isama ang pagsamba (adoration), "Sambahin ang Ngalan Mo." Dapat nating luwalhatiin at sambahin ang Kanyang pangalan, ang Kanyang pagka-Diyos.',
            'sort_order' => 24,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MANALANGIN, MANALANGIN, MANALANGIN!',
            'sort_order' => 25,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => '... sa (ng may) pananampalataya (Marcos 11:24; Mga Hebreo 10:22)',
            'sort_order' => 26,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => '... nang may espiritung nagpapatawad (Marcos 11:25)',
            'sort_order' => 27,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => '... nang may katiyagaan (Lucas 11:8; 18:1–7)',
            'sort_order' => 28,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => '... sa (ng may) katuwiran (Mga Awit 34:15; Juan 15:7)',
            'sort_order' => 29,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Maglaan ng palagiang oras at pumili ng pinakamainam na lugar. Ang makalat na isipan ay nagbubunga ng personal na kaguluhan. Ang makalat na espiritu ay nangangailangan ng panalangin upang ito\'y linisin at mabigyan ng direksyon.',
            'sort_order' => 30,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Gawin mong una sa lahat ang panalangin sa bawat araw. Hanapin ang isang tiyak na lugar sa iyong tahanan kung saan ikaw ay masisiyahan sa presensya ng Diyos.',
            'sort_order' => 31,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang panalangin ay hindi isang gawain o isang pasanin; sa halip, ito ay isang pintuan sa isang mapagmahal, personal, at malapit na pakikipag-ugnayan sa Diyos.',
            'sort_order' => 32,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Pasimulan sa pagpapasalamat at papuri. Ang pagpapasalamat at papuri ay ang handog ng iyong kaluluwa sa Diyos.',
            'sort_order' => 33,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Si Yahweh ay papurihan, paglingkuran siyang kusa; lumapit sa presensya niya at umawit na may tuwa! O si Yahweh ay ating Diyos! Ito\'y dapat na malaman, tayo\'y kanya, kanyang lahat, tayong lahat na nilalang; lahat tayo\'y bayan niya, kabilang sa kanyang kawan.

Pumasok sa kanyang templo na ang puso\'y nagdiriwang, umaawit, nagpupuri sa loob ng dakong banal; purihin ang ngalan niya at siya\'y pasalamatan! Napakabuti ni Yahweh, pag-ibig niya\'y walang hanggan, pag-ibig niya ay tunay, laging tapat kailanman!"',
            'reference' => 'Mga Awit 100:2–5',
            'sort_order' => 34,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Hayaang makipag-ugnayan ang iyong puso sa puso ng Diyos. Ang mga salitang gumagawa dito ay: ISINUSUKO KO ANG LAHAT.',
            'sort_order' => 35,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ikaw ay isang anak sa harapan ng iyong Ama. Hayaan mong mangusap sa iyong puso ang Diyos at magministeryo sa iyong kaluluwa habang ibinubuhos mo ang laman ng iyong puso sa Kanya.',
            'sort_order' => 36,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Ipahayag ang iyong pananampalataya. Angkinin ang mga pangakong tulong ng Diyos.',
            'sort_order' => 37,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t sinasabi ko sa inyo, humingi kayo at kayo\'y bibigyan; humanap kayo at kayo\'y makakatagpo; kumatok kayo at kayo\'y pagbubuksan. Sapagkat ang bawat humihingi ay tatanggap; ang bawat humahanap ay makakatagpo; at ang bawat kumakatok ay pagbubuksan."',
            'reference' => 'Lucas 11:9–10',
            'sort_order' => 38,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung ano ang sinabi ng Diyos, ay aking ipinapahayag at Kanya itong gagawin.',
            'sort_order' => 39,
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
            'content' => 'Sa iyong araw-araw na buhay, gaanong oras ang ilalaan mo sa panalangin? Sapat ba upang patatagin ang iyong relasyon sa Diyos?

Paano mo haharapin ang mga gambala sa panahon ng panalangin sa Panginoon?',
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
            'content' => 'Panginoon, salamat sa Iyong presensya na nagbibigay sa akin ng lakas at ng kakayahan upang magawa ko ang lahat para sa Iyong kaluwalhatian.

Tulungan Mo akong makalikha ng isang buhay pananalangin at lumago sa pananampalataya sa pamamagitan ng paghahanap sa Iyong mukha nang may pagtitiwala araw-araw.

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
            'title' => 'Pagpapatotoo',
            'subtitle' => 'Pagbabahagi ng Iyong Bagong Buhay sa Iba',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'Pagpapatotoo',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'IPAGPAHAYAG ANG MABUTING BALITA',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Paano naman sila tatawag sa kanya kung hindi sila sumasampalataya? Paano sila sasampalataya kung wala pa silang napakinggan tungkol sa kanya? Paano naman sila makakapakinig kung walang mangangaral sa kanila?"',
            'reference' => 'Mga Taga-Roma 10:14',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Narinig mo ang patungkol kay Hesus sapagkat may nagsabi sa iyo nito. Ngayon, ikaw ay may pribilehiyo na maibahagi ang Mabuting Balita sa iba.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Bilang mga tagasunod ni Hesu-Kristo, tayo ay isinugo upang ipaalam sa iba ang patungkol kay Hesus at ang iniaalok Niyang buhay.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Hindi ko ikinahihiya ang Magandang Balita, sapagkat ito ang kapangyarihan ng Diyos para sa kaligtasan ng bawat sumasampalataya, una\'y sa mga Judio at gayundin sa mga Griego."',
            'reference' => 'Mga Taga-Roma 1:16',
            'sort_order' => 6,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'IPAHAYAG SA SANLIBUTAN ANG TUNGKOL KAY HESUS!',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay may isang kahanga-hangang gawain na tinatawag na "Great Commission" na ibinigay ni Hesus sa lahat ng Kanyang tagasunod bago Niya lisanin ang mundo upang magtungo sa langit.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Dahil dito, tayo ay may pangitain upang akayin ang mga kaluluwa at sila\'y turuang maging tagasunod (vision to win souls and make disciples).',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya\'t habang kayo\'y humahayo, gawin ninyong alagad ko ang mga tao sa lahat ng bansa. Bautismuhan ninyo sila sa pangalan ng Ama, at ng Anak, at ng Espiritu Santo. Turuan ninyo silang sumunod sa lahat ng iniutos ko sa inyo. Tandaan ninyo, ako\'y laging kasama ninyo hanggang sa katapusan ng panahon."',
            'reference' => 'Mateo 28:19–20',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayo ay pinagkalooban ng pagkakataon upang maging pagpapala sa ibang tao, lalo na sa mga miyembro ng ating pamilya. Kailangan nilang marinig ang tungkol kay Hesus at upang magawa ito, ang unang dapat nating gawin ay ipanalangin sila.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maaari din naman na sadyain mo ang pagtulong, pagpalain, paglingkuran, at pakitaan sila ng kabutihan upang ikaw ay magkaroon ng pagkakataon na maibahagi ang iyong kuwento sa kanila.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'IBAHAGI ANG IYONG KUWENTO',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Naaalala mo kung ano ang buhay na wala si Kristo, at ang karanasan mo ng kaligtasan mula sa iyong dating buhay ay maaaring magpaapoy sa iyong pagnanasa na magbahagi sa iba.',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pagkatapos mong makalikha ng ugnayan (connection) sa isang tao, manalangin para sa isang pagkakataon upang maibahagi kung ano ang nagawa ni Hesus sa iyong buhay.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pinakamainam na paraan upang maibahagi sa tao ay ipahayag mo ang iyong sariling kuwento kung paano kumilos at paano binago ni Hesus ang iyong buhay.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Maghanda ng isang maikling bersyon ng sariling kuwento ng pananampalataya na nagsisimula sa isang masama at malungkot na kuwento na iniligtas ni Hesus, na nagpapatuloy sa kuwento ng Mabuting Balita.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ibahagi kung paano binago ni Hesus ang kuwento ng iyong buhay na ngayon ay naaayon sa Kanyang panukala (plan).',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'HINGIN ANG KANILANG PAGPAPASYA AT AKAYIN SILA SA PANALANGIN',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Habang ikaw ay nagbabahagi, kikilos ang Diyos sa puso ng tao. Maging malaya sa pagtatanong kung nauunawaan ng tao at kung nais nilang tanggapin ang kaloob na kaligtasan ng Diyos.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung sila\'y handa na sa isang pagpapasya, akayin sila sa isang panalangin ng pagtanggap sa kung ano ang ginawa ni Hesus para sa kanila.',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'prayer',
            'content' => '"Hesus, salamat sa pag-ibig na Iyong ipinakita noong Ikaw ay mamatay sa krus upang bayaran ang aking mga kasalanan. Patawarin Mo ako, pumasok Ka sa aking puso, at maging Panginoon Ka ng aking buhay at tulungan Mo akong mamuhay para sa Iyo mula ngayon. Sa pangalan ni Hesus, ito ang aking panalangin, Amen."',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pagkatapos nito, tulungan ang tao na mapatatag sa kanyang bagong pananampalataya kung paano mo rin itong naranasan.',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi magtatagal, ang taong ito ay magbabahagi na rin sa ibang tao ng kanilang kagalakan ng kaligtasan.',
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
            'content' => 'Isipin ang mga tao na nais mong bahaginan ng iyong kuwento at simulan mo silang ipanalangin.

Tulungan, pagpalain, at pakitaan ng kabutihan ang mga taong ito at maging handa sa mga pagkakataon na ibibigay sa iyo ng Diyos upang ibahagi sa kanila ang ginawa Niya sa iyong buhay.',
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
            'content' => 'Panginoong Diyos, salamat sa Iyong kaloob na kaligtasan at sa pribilehiyo na makatulong sa ibang tao upang makilala Ka rin nila.

Ipakita Mo sa akin ang mga pagkakataon na makatulong, magpala, at makapaglingkod sa kanila.

Ngayon pa lamang, buksan Mo na ang kanilang mga puso upang tanggapin Ka nila bilang Panginoon at Tagapagligtas.

Sa pamamagitan ng kapangyarihan ng Iyong Espiritu, inaangkin ko ang tagumpay sa buhay ng mga taong ito.

Amen.',
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
            'title' => 'Buhay ng Pagsunod (Pagsuko sa Kalooban ng Diyos)',
            'subtitle' => 'Life of Obedience (Surrender to God\'s Will)',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'Buhay ng Pagsunod (Pagsuko sa Kalooban ng Diyos)',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung nabubuhay man kami sa mundong ito, hindi naman kami nakikipaglaban ayon sa pamamaraan ng mundong ito. Ang sandatang ginamit namin sa pakikipaglaban ay hindi sandatang makamundo, kundi ang kapangyarihan ng Diyos na nakakapagpabagsak ng mga kuta. Sinisira namin ang mga maling pangangatuwiran, ginagapi namin ang lahat ng pagmamataas laban sa kaalaman tungkol sa Diyos, at binibihag namin ang lahat ng isipan upang matutong sumunod kay Cristo."',
            'reference' => '2 Mga Taga-Corinto 10:3–6',
            'sort_order' => 2,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG LABANAN SA PAGITAN NG ESPIRITU AT NG LAMAN',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'May isang tahimik na labanan sa pagitan ng espiritu at ng laman. Ang laman ay sadyang nakahilig na bumagsak sa mga patibong ng kaaway sa immoralidad, karumihan, kahayupan (debauchery), at mga bagay na nagdadala sa iyong paningin at puso sa pandaraya (Mga Taga-Galacia 5:19–21).',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ngunit ang pagtanggap sa Diyos at ang pagpapahintulot sa Kanya na kumilos sa iyong buhay ang siyang nagbabantay sa iyo mula sa mga bagay na iyon at nagbibigay sa iyo ng bunga ng Kanyang Espiritu: pag-ibig, kagalakan, kapayapaan, katiyagaan, kabaitan, kabutihan, katapatan, kahinahunan, at pagpipigil sa sarili (Mga Taga-Galacia 5:22–23).',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'MATALINONG PAGPILI HABANG NATUTUTUNAN MONG SUMUNOD KAY KRISTO',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ating buhay ay umiikot sa pagsunod at pagsuway. Anumang anyo ng pagsuway ay dapat na mapagtagumpayan sa pamamagitan ng dakilang lakas ng ating pagsunod sa Panginoon sa pamamagitan ng kapangyarihan ng Banal na Espiritu.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Habang tayo ay sumusunod sa Diyos, tayo ay may kakayahang magkaroon ng isang buhay na karapat-dapat sa Kanyang tawag (calling) at tumanggap ng mga pangako Niya para sa atin.',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pagsunod ay kinakailangan upang mapagtagumpayan ang mga pasanin o pabigat (pressures) at mga pagsubok. Kapag tayo ay tumatalima at sumusunod sa Diyos, isang matibay na pundasyon ang natatayo upang sa pagdating ng pagsubok, tayo\'y hindi matitinag. (Lucas 6:46–48)',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung iniibig ninyo ako, tutuparin ninyo ang aking mga itinuturo."',
            'reference' => 'Juan 14:15',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ito ang kahulugan ng pag-ibig na binabanggit ko: mamuhay tayo nang ayon sa mga kalooban ng Diyos. Ito ang utos na ibinigay sa inyo noong pang una: mamuhay kayo sa diwa ng pag-ibig."',
            'reference' => '2 Juan 1:6',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'TATLONG MAHAHALAGANG BAHAGI NG PAGSUNOD',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Kinakailangan nating maging masunurin sa katotohanan ng Salita ng Diyos.',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Maaaring mayroon sa inyo diyan na hindi susunod sa sinasabi namin sa sulat na ito. Kung magkagayon, tandaan ninyo siya at huwag kayong makihalubilo sa kanya, upang siya\'y mapahiya."',
            'reference' => '2 Mga Taga-Tesalonica 3:14',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Ang tumatanggap sa mga utos ko at tumutupad nito ang siyang umiibig sa akin. Ang umiibig sa akin ay iibigin ng aking Ama; iibigin ko rin siya at ako\'y lubusang magpapakilala sa kanya."',
            'reference' => 'Juan 14:21',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Kinakailangan nating maging masunurin sa tinig ng Banal na Espiritu.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Kaya\'t tulad ng sinabi ng Espiritu Santo, "Kapag narinig ninyo ngayon ang tinig ng Diyos, iyang inyong puso\'y huwag patigasin, tulad noong maghimagsik ang inyong mga ninuno doon sa ilang, nang subukin nila ako."',
            'reference' => 'Mga Hebreo 3:7–8',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'list',
            'content' => 'Kinakailangang magkaroon ng kusa at maluwag na kalooban (willingness) na sumunod.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kung susundin ninyo ang aking sinasabi, tatamasahin ninyo ang ani ng inyong lupain. Ngunit kung susuway kayo at maghihimagsik, tiyak na kayo\'y mamamatay. Ito ang mensahe ni Yahweh."',
            'reference' => 'Isaias 1:19–20',
            'sort_order' => 17,
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
            'content' => 'Sumunod at magpasakop sa Salita ng Diyos sa pamamagitan ng mga pagtutuwid ng iyong mga tagapanguna (leaders), pagtuturo, at paggabay sapagkat sila ang mga itinalaga ng Diyos na mamahala o manguna sa iyo.

Igalang at makinig sa iyong mga magulang at mga guro/boss habang sila ay nagsasabi ng mga bagay na kinakailangan mong pagbutihin.',
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
            'content' => 'Isinusuko ko ang aking buhay sa Iyo, Panginoon, at aking kinikilala ang Iyong Salita bilang may lubos na kapamahalaan sa aking buhay.

Ipagkaloob Mo sa akin ang puso na magpasakop sa Iyong mga panukala at sumunod sa aking mga tagapanguna sa iglesia, sa aking mga magulang, mga guro/boss, at sa lahat ng may kapangyarihan.

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
            'title' => 'Buhay sa Iglesia (Ang Mapabilang sa Iglesia)',
            'subtitle' => 'Life in the Church (Belongingness in the Church)',
            'summary' => null,
            'image' => 'https://images.unsplash.com/photo-1486299267070-83823f5448dd?w=800&q=80',
        ]);

        $headerPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'header',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'heading',
            'content' => 'BUHAY IGLESIA (ANG PAGIGING KABILANG SA IGLESIA)',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'scripture',
            'content' => '"Sikapin din nating gisingin ang damdamin ng bawat isa sa pagmamahal sa kapwa at sa paggawa ng mabuti. Huwag nating kaliligtaan ang pagdalo sa ating mga pagtitipon, gaya ng ginagawa ng ilan. Sa halip, palakasin natin ang loob ng isa\'t isa, lalo na ngayong nakikita nating malapit na ang araw ng Panginoon."',
            'reference' => 'Mga Hebreo 10:24–25',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang iglesia ay isang lugar na nakadisenyo upang magkaroon ng espirituwal na pagpapalakas (encouragement), pagbibigay-buhay (inspiration), at kaganapan (fulfillment). Hindi ito isang gusali kundi isang lugar upang mapabilang. Ito ay isang espirituwal na pamilya (ang bayan ng Diyos) kung saan nananahan ang presensya ng Diyos.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $headerPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ito rin ay isang lugar para sa nakatuong pagsamba kung saan maaari tayong maghandog at parangalan ang Diyos sa pamamagitan ng mga pag-aawitan, pagbibigay, at pakikinig sa Kanyang mga Salita.',
            'sort_order' => 4,
        ]);

        $bodyPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'body',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG MGA PAKINABANG SA PAGSASAMA-SAMA (COMMUNITY) SA KATAWAN NI KRISTO',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hinihikayat tayo ni Pablo sa Mga Taga-Hebreo 10:25 na huwag kaligtaan o pabayaan ang pagtitipon, sa halip ay magpalakasan sa isa\'t isa.',
            'sort_order' => 2,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kung paanong napapanatili ng mga baga ang kanilang init kapag sila\'y sama-sama, kailangan mo rin ang ibang tao na makatutulong sa iyo upang patuloy na nag-aalab ang iyong apoy.',
            'sort_order' => 3,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tinutulungan tayo ng iglesia upang lumago at upang maranasan ang isang nabagong buhay. Tutulungan tayo nito na maging katulad ni Kristo at magkaroon ng walang pasubaling pag-ibig (unconditional love) sa mga taong hindi nakaranas ng pagmamahal.',
            'sort_order' => 4,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tuturuan din tayo nito sa kahalagahan ng paglilingkod.',
            'sort_order' => 5,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Hindi ganyan ang dapat umiral sa inyo. Kung nais ninyong maging dakila, dapat kayong maging lingkod sa iba."',
            'reference' => 'Mateo 20:26',
            'sort_order' => 6,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'ANG PAGHAHANAP NG PAMAYANAN (COMMUNITY) SA ISANG IGLESIA LOKAL',
            'sort_order' => 7,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang pamayanan ni Kristo ay ang mga taong nakaranas ng nabagong buhay. Ang mapabilang sa isa\'t isa ay nag-uugat sa pagiging na kay Kristo natin; ito ang dahilan ng ating lubos na kaibahan!',
            'sort_order' => 8,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang ating espirituwal na buhay ay hindi tatagal nang nag-iisa. Tulad ng isdang inalis sa tubig, o ng punong binunot mula sa lupa, ang ating espirituwal na buhay ay mamamatay kung hindi matatanim sa presensya ng Diyos.',
            'sort_order' => 9,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Kailangang maunawaan ng bawat isa kung saan patungkol ang iglesia at ang mga kadahilanan kung bakit dapat tayong magbalik sa iglesia.',
            'sort_order' => 10,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Una sa lahat, isa tayong "pamayanang sumasamba."',
            'sort_order' => 11,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sinimulan ni Pablo ang kabanatang ito sa pamamagitan ng pagsasabing:',
            'sort_order' => 12,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => '"Kaya nga, mga kapatid, ..., ako\'y nakikiusap na ialay ninyo ang inyong sarili bilang isang handog na buhay, banal at kalugud-lugod sa Diyos. Ito ang karapat-dapat na pagsamba ninyo sa Diyos. Huwag kayong makiayon sa takbo ng mundong ito. Mag-iba kayo sa pamamagitan ng pagbabago ng inyong pag-iisip ..."',
            'reference' => 'Mga Taga-Roma 12:1–2',
            'sort_order' => 13,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hinahayaan natin ang Diyos na tayo ay anyuan, ayusin, at hubugin habang Siya ay ating ipinapahayag bilang Panginoon natin ng lahat.',
            'sort_order' => 14,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pangalawa, dapat tayong kumilos bilang "pamayanang naglilingkod."',
            'sort_order' => 15,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Dito nagiging napaka-praktikal ang pagkakaiba-iba ng komunidad. Tayo ay tinawag upang maglingkod sa isa\'t isa sa pamamagitan ng ating mga espirituwal na kaloob na ibinigay sa atin ng Panginoon.',
            'sort_order' => 16,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Basahin ang Mga Taga-Roma 12:6–8. Binanggit ni Pablo ang pitong espirituwal na kaloob at napansin mo ba na ang mga ito\'y magkakaiba?',
            'reference' => 'Mga Taga-Roma 12:6–8',
            'sort_order' => 17,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang mga ito\'y magkakaiba—at ito nga ang pinaka-punto nito. Ang bawat isa sa atin ay may kakaiba (unique) at tiyak (specific) na maiaambag sa ating iglesia sa pamamagitan ng mga espirituwal na kaloob na ipinagkaloob sa atin ng Diyos.',
            'sort_order' => 18,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Pangatlo, tayo ay "pamayanang mapagmahal."',
            'sort_order' => 19,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Tayong lahat ay tinawag upang maging "pamayanang mapagmahal." Sa talatang 9–21, nagtatapos si Pablo sa kabanatang ito ng listahan ng mga praktikal na pahiwatig (practical implications) para sa ating pang-araw-araw na buhay bilang mga tagasunod ni Hesus.',
            'sort_order' => 20,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Ang lahat ng mga ito\'y ang pinatutunguhan ay "pag-ibig."',
            'sort_order' => 21,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'scripture',
            'content' => 'Mga Taga-Roma 12:9–13:

"Maging tunay ang inyong pagmamahalan... Magmahalan kayo bilang tunay na magkakapatid... Magpakasipag kayo at huwag maging tamad. Buong puso kayong maglingkod sa Panginoon. Magalak kayo dahil sa inyong pag-asa,... Tumulong kayo sa pangangailangan ng mga kapatid at patuluyin ninyo ang mga taga-ibang lugar."',
            'reference' => 'Mga Taga-Roma 12:9–13',
            'sort_order' => 22,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'heading',
            'content' => 'PAMUMUHAY BILANG BAHAGI NG ISANG PAMILYA',
            'sort_order' => 23,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Hindi ninais ng Diyos na ang Kanyang mga anak ay mamuhay bilang mga espirituwal na ulila.',
            'sort_order' => 24,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Sa parehong paraan na ang isang basketball player ay kabilang sa isang koponan (team) at ang isang sundalo ay kabilang sa isang pulutong (platoon), plano ng Diyos na ang bawat isa sa Kanyang mga anak ay mapabilang sa isang pamilya.',
            'sort_order' => 25,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $bodyPart->id,
            'block_type' => 'paragraph',
            'content' => 'Lahat tayo ay kailangang maging bahagi ng isang bagay na higit na malaki kaysa sa atin at maranasan ang magkaroon ng espirituwal na pamilya, pamayanan, at pagsasama-sama kung saan ang Diyos ang Panginoon at Ama.',
            'sort_order' => 26,
        ]);

        $endPart = PepsolLessonParts::create([
            'pepsol_lesson_id' => $lesson->id,
            'part_key' => 'end',
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'heading',
            'content' => 'PRACTICAL APPLICATION',
            'sort_order' => 1,
        ]);

        PepsolLessonBlock::create([
            'pepsol_lesson_part_id' => $endPart->id,
            'block_type' => 'question',
            'content' => 'Italaga ang iyong sarili sa iglesia at ituring mo sila na iyong pamilya na nakatalaga upang matulungan kang mailabas ang pinakamainam sa iyo.

Isipin kung paano at ano ang iyong maaaring maiambag sa ibang tao.

Makilahok sa mga gawain at paglilingkod ng iglesia upang ikaw ay lumagong kasama nila.',
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
            'content' => 'Ako ay lubos na nagpapasalamat sa Iyo, Panginoon, sa paglalagay Mo sa akin sa isang kahanga-hangang pamilyang espirituwal na tinatawag na iglesia.

Tulungan Mo akong maitalaga ang aking sarili sa pamilyang ito at makibahagi habang tinutulungan naming ang bawat isa na mailabas ang mga pinakamainam na nasa amin patungo sa pagiging katulad ni Kristo at sa pagiging mabunga.',
            'sort_order' => 2,
        ]);
    }
}
