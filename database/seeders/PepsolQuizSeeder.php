<?php

namespace Database\Seeders;

use App\Models\PepsolLesson;
use App\Models\PepsolQuiz;
use App\Models\PepsolQuestion;
use App\Models\PepsolQuestionOption;
use Illuminate\Database\Seeder;

class PepsolQuizSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = PepsolLesson::orderBy('id')->get();

        foreach ($lessons as $index => $lesson) {
            $this->createQuizForLesson($lesson, $index + 1);
        }
    }

    private function createQuizForLesson($lesson, $lessonNumber)
    {
        $quiz = PepsolQuiz::create([
            'pepsol_lesson_id' => $lesson->id,
            'title' => 'Quiz: ' . $lesson->title,
            'description' => 'Test your understanding of ' . $lesson->title . ' lesson.',
            'instructions' => 'Read each question carefully and select the best answer. You need to score at least 5 out of 10 to pass.',
            'passing_score' => 50,
            'allow_retake' => true,
            'max_attempts' => 3,
            'status' => 'published',
        ]);

        switch ($lessonNumber) {
            case 1:
                $this->createLesson1Quiz($quiz);
                break;
            case 2:
                $this->createLesson2Quiz($quiz);
                break;
            case 3:
                $this->createLesson3Quiz($quiz);
                break;
            case 4:
                $this->createLesson4Quiz($quiz);
                break;
            case 5:
                $this->createLesson5Quiz($quiz);
                break;
            case 6:
                $this->createLesson6Quiz($quiz);
                break;
            case 7:
                $this->createLesson7Quiz($quiz);
                break;
            case 8:
                $this->createLesson8Quiz($quiz);
                break;
            case 9:
                $this->createLesson9Quiz($quiz);
                break;
            case 10:
                $this->createLesson10Quiz($quiz);
                break;
        }
    }

    private function createLesson1Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ano ang kahulugan ng Ebanghelyo?',
                'options' => [
                    'Ang Mabuting Balita ng kaligtasan' => true,
                    'Isang kwento tungkol sa paglikha' => false,
                    'Isang utos ng Diyos' => false,
                    'Ang kasaysayan ng Israel' => false,
                ],
                'explanation' => 'Ang Ebanghelyo ay ang Mabuting Balita ng kaligtasan sa pamamagitan ng pananampalataya kay Kristo.'
            ],
            [
                'question' => 'Ayon sa Mga Taga-Roma 6:23, ano ang kabayaran ng kasalanan?',
                'options' => [
                    'Kamatayan' => true,
                    'Kahihiyan' => false,
                    'Kahirapan' => false,
                    'Kawalan ng pag-asa' => false,
                ],
                'explanation' => 'Ang kabayaran ng kasalanan ay kamatayan, ngunit ang kaloob ng Diyos ay buhay na walang hanggan.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng pagiging "bagong nilalang" kay Kristo?',
                'options' => [
                    'Ang lumang pagkatao ay naglaho at napalitan ng bago' => true,
                    'Ang tao ay nagiging perpekto' => false,
                    'Ang tao ay hindi na nagkakasala' => false,
                    'Ang tao ay nagiging anghel' => false,
                ],
                'explanation' => 'Ayon sa 2 Corinto 5:17, ang nakipag-isa kay Kristo ay bagong nilalang.'
            ],
            [
                'question' => 'Sino ang tanging daan patungo sa Diyos ayon sa Juan 14:6?',
                'options' => [
                    'Si Hesus' => true,
                    'Si Moises' => false,
                    'Si Elias' => false,
                    'Si Pablo' => false,
                ],
                'explanation' => 'Sinabi ni Hesus na Siya ang daan, katotohanan, at buhay. Walang makakapunta sa Ama kundi sa Kanya.'
            ],
            [
                'question' => 'Ano ang ipinahihiwatig ng dugo ni Hesus na nabuhos sa krus?',
                'options' => [
                    'Kapatawaran ng mga kasalanan' => true,
                    'Pagkondena sa mga makasalanan' => false,
                    'Paghatol sa sanlibutan' => false,
                    'Pagbagsak ng templo' => false,
                ],
                'explanation' => 'Ang dugo ni Hesus ay ibinuhos para sa kapatawaran ng mga kasalanan.'
            ],
            [
                'question' => 'Ano ang nangyayari sa isang tao sa sandaling tanggapin niya si Kristo?',
                'options' => [
                    'Siya ay nagiging anak ng Diyos' => true,
                    'Siya ay nagiging perpekto' => false,
                    'Siya ay umaakyat sa langit' => false,
                    'Siya ay tumatanggap ng kapangyarihang gumawa ng himala' => false,
                ],
                'explanation' => 'Ayon sa Juan 1:12, ang tumatanggap kay Kristo ay binibigyan ng karapatang maging anak ng Diyos.'
            ],
            [
                'question' => 'Ayon sa Mga Hebreo 13:5, ano ang pangako ng Diyos sa Kanyang mga anak?',
                'options' => [
                    'Hindi Niya tayo iiwanan kailanman' => true,
                    'Bibigyan Niya tayo ng kayamanan' => false,
                    'Tatanggalin Niya ang lahat ng pagsubok' => false,
                    'Gagawin Niya tayong hari' => false,
                ],
                'explanation' => 'Pangako ng Diyos na hindi tayo iiwanan o pababayaan kailanman.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "buhay na walang hanggan" ayon sa 1 Juan 5:11-13?',
                'options' => [
                    'Ang maranasan ang buhay na kasama ang Diyos magpakailanman' => true,
                    'Ang mabuhay ng matagal sa lupa' => false,
                    'Ang magkaroon ng maraming ari-arian' => false,
                    'Ang maging sikat sa mundo' => false,
                ],
                'explanation' => 'Ang buhay na walang hanggan ay ang makasama ang Diyos magpakailanman sa pamamagitan ni Kristo.'
            ],
            [
                'question' => 'Bakit kailangan natin ng isang Tagapagligtas?',
                'options' => [
                    'Dahil ang lahat ay nagkasala at nangangailangan ng kaligtasan' => true,
                    'Dahil gusto nating maging mayaman' => false,
                    'Dahil gusto nating maging popular' => false,
                    'Dahil gusto nating magkaroon ng kapangyarihan' => false,
                ],
                'explanation' => 'Ang lahat ay nagkasala at nangangailangan ng kaligtasan mula sa walang hanggang kamatayan.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "pagtubos" na ginawa ni Hesus sa krus?',
                'options' => [
                    'Pagbili pabalik mula sa pagkaalipin ng kasalanan' => true,
                    'Pagkondena sa mga makasalanan' => false,
                    'Pagpapabaya sa mga kasalanan' => false,
                    'Pagbibigay ng kapangyarihan sa sanlibutan' => false,
                ],
                'explanation' => 'Si Hesus ay nagbayad ng kabayaran para sa ating mga kasalanan upang tayo ay matubos mula sa pagkaalipin ng kasalanan.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson2Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ano ang kahulugan ng pagsisisi?',
                'options' => [
                    'Pagbabago ng direksyon at paglayo sa kasalanan' => true,
                    'Paghingi ng tawad' => false,
                    'Pagkakasala' => false,
                    'Paglimot sa nakaraan' => false,
                ],
                'explanation' => 'Ang pagsisisi ay pagbabago ng isip at paglayo sa kasalanan patungo sa Diyos.'
            ],
            [
                'question' => 'Ayon sa Mga Taga-Roma 2:4, ano ang umaakay sa atin sa pagsisisi?',
                'options' => [
                    'Ang kabutihan ng Diyos' => true,
                    'Ang takot sa parusa' => false,
                    'Ang pagkakasala' => false,
                    'Ang kahihiyan' => false,
                ],
                'explanation' => 'Ang kabutihan ng Diyos ang umaakay sa atin sa pagsisisi.'
            ],
            [
                'question' => 'Ano ang tawag sa karanasan ng pagkakaroon ng bagong buhay sa Espiritu?',
                'options' => [
                    'Kapanganakang muli' => true,
                    'Pagbabago ng isip' => false,
                    'Pagkilos ng Espiritu' => false,
                    'Pagpapakumbaba' => false,
                ],
                'explanation' => 'Ang kapanganakang muli sa Espiritu ng Diyos ay dumarating sa pamamagitan ng pagsisisi at pananampalataya.'
            ],
            [
                'question' => 'Ano ang ipinakita ng Diyos sa talinghaga ng alibughang anak?',
                'options' => [
                    'Ang walang hanggang pag-ibig at kapatawaran ng Diyos' => true,
                    'Ang katarungan ng Diyos' => false,
                    'Ang kapangyarihan ng Diyos' => false,
                    'Ang paghuhukom ng Diyos' => false,
                ],
                'explanation' => 'Ang talinghaga ng alibughang anak ay nagpapakita ng pag-ibig at kapatawaran ng Diyos sa mga nagsisisi.'
            ],
            [
                'question' => 'Ayon sa 2 Pedro 3:9, bakit matiyagang naghihintay ang Diyos?',
                'options' => [
                    'Upang tayo ay magsisi' => true,
                    'Upang tayo ay parusahan' => false,
                    'Upang tayo ay subukin' => false,
                    'Upang tayo ay palayain' => false,
                ],
                'explanation' => 'Ang Diyos ay matiyagang naghihintay upang ang lahat ay magsisi.'
            ],
            [
                'question' => 'Ano ang kailangan ng tao upang tumanggap ng kaligtasan?',
                'options' => [
                    'Pagsisisi at pananampalataya kay Hesus' => true,
                    'Pagdalo sa simbahan' => false,
                    'Paggawa ng mabuti' => false,
                    'Pag-aayuno' => false,
                ],
                'explanation' => 'Kailangan ng pagsisisi at pananampalataya kay Hesu-Kristo para sa kaligtasan.'
            ],
            [
                'question' => 'Ayon sa Mga Gawa 3:19, ano ang dapat gawin upang mapawi ang kasalanan?',
                'options' => [
                    'Magsisi at bumalik sa Diyos' => true,
                    'Magbigay ng handog' => false,
                    'Magdasal ng maraming beses' => false,
                    'Mag-ayuno' => false,
                ],
                'explanation' => 'Ang pagsisisi at pagbabalik sa Diyos ang nagpapawi ng kasalanan.'
            ],
            [
                'question' => 'Ano ang ipinakikita ng pag-ibig ng Diyos sa pagsisisi?',
                'options' => [
                    'Ang Kanyang awa at pagtitiyaga' => true,
                    'Ang Kanyang galit' => false,
                    'Ang Kanyang parusa' => false,
                    'Ang Kanyang kawalang-interes' => false,
                ],
                'explanation' => 'Ang pag-ibig ng Diyos ay ipinakita sa Kanyang awa at pagtitiyaga sa ating pagsisisi.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "pagbabago ng kaisipan" sa pagsisisi?',
                'options' => [
                    'Pagkakaroon ng bagong pananaw tungkol sa Diyos, sa sarili, at sa sanlibutan' => true,
                    'Paglimot sa nakaraan' => false,
                    'Pagiging relihiyoso' => false,
                    'Pagsunod sa tradisyon' => false,
                ],
                'explanation' => 'Ang pagbabago ng kaisipan ay nagbibigay ng bagong pananaw sa Diyos, sa sarili, at sa mundo.'
            ],
            [
                'question' => 'Ano ang pangunahing motibasyon para sa pagsisisi?',
                'options' => [
                    'Ang pag-ibig sa Diyos at pagnanasang sumunod sa Kanya' => true,
                    'Ang takot sa kamatayan' => false,
                    'Ang pagnanais na maging mayaman' => false,
                    'Ang takot sa paghuhukom' => false,
                ],
                'explanation' => 'Ang pagsisisi ay inuudyukan ng pag-ibig sa Diyos at pagnanasang sumunod sa Kanya.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson3Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ano ang kahulugan ng pagiging Panginoon ni Kristo?',
                'options' => [
                    'Ang pagkilala na Siya ang may-ari at maestro ng ating buhay' => true,
                    'Ang pagkilala na Siya ay isang propeta' => false,
                    'Ang pagkilala na Siya ay isang guro' => false,
                    'Ang pagkilala na Siya ay isang lider' => false,
                ],
                'explanation' => 'Ang pagiging Panginoon ni Kristo ay nangangahulugan na Siya ang may-ari at namamahala sa ating buhay.'
            ],
            [
                'question' => 'Ayon sa Mga Gawa 2:36, sino si Hesus?',
                'options' => [
                    'Parehong Panginoon at Kristo' => true,
                    'Isang propeta lamang' => false,
                    'Isang guro lamang' => false,
                    'Isang lider lamang' => false,
                ],
                'explanation' => 'Ginawa ng Diyos si Hesus na parehong Panginoon at Kristo (Messias).'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "Panginoon"?',
                'options' => [
                    'Tagapagmay-ari at maestro' => true,
                    'Kaibigan' => false,
                    'Kasama' => false,
                    'Taga-payo' => false,
                ],
                'explanation' => 'Ang salitang "Panginoon" ay nangangahulugang tagapagmay-ari at maestro.'
            ],
            [
                'question' => 'Ano ang mga kabutihang dulot ng pagpapailalim sa pagka-Panginoon ni Kristo?',
                'options' => [
                    'Tayo ay nananagana at tumatanggap ng pag-asa' => true,
                    'Tayo ay nagiging mayaman sa materyal' => false,
                    'Tayo ay nagiging sikat' => false,
                    'Tayo ay nagiging malaya sa problema' => false,
                ],
                'explanation' => 'Ang pagpapailalim kay Kristo ay nagdudulot ng kasaganaan, pag-asa, at magandang kinabukasan.'
            ],
            [
                'question' => 'Ano ang dapat na tugon ng tao sa pagka-Panginoon ni Hesus?',
                'options' => [
                    '"Opo, Panginoon!" (Yes, Lord!)' => true,
                    'Pananahimik' => false,
                    'Pag-aalinlangan' => false,
                    'Pagtanggi' => false,
                ],
                'explanation' => 'Ang ating tugon sa pagka-Panginoon ni Hesus ay "Opo, Panginoon!"'
            ],
            [
                'question' => 'Ayon sa Jeremias 29:11, ano ang layunin ng Diyos para sa atin?',
                'options' => [
                    'Magandang kinabukasan at pag-asa' => true,
                    'Pagdurusa' => false,
                    'Kahirapan' => false,
                    'Pagkabigo' => false,
                ],
                'explanation' => 'Ang Diyos ay may magandang plano para sa atin - kinabukasan at pag-asa.'
            ],
            [
                'question' => 'Paano tayo lumalago sa pananampalataya?',
                'options' => [
                    'Sa pamamagitan ng pagkilala, pagtitiwala, at pagsunod kay Kristo' => true,
                    'Sa pamamagitan ng pagparusa sa sarili' => false,
                    'Sa pamamagitan ng paghahanap ng lihim na kaalaman' => false,
                    'Sa pamamagitan ng mga natatanging kapahayagan' => false,
                ],
                'explanation' => 'Lumalago tayo sa pananampalataya sa pamamagitan ng pagkilala, pagtitiwala, at pagsunod kay Kristo.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng pamumuhay na banal?',
                'options' => [
                    'Bunga ng isang buhay na nabago ni Kristo' => true,
                    'Pagsunod sa tradisyon ng tao' => false,
                    'Pagiging relihiyoso' => false,
                    'Pag-iwas sa mundo' => false,
                ],
                'explanation' => 'Ang banal na pamumuhay ay bunga ng pagbabagong ginawa ni Kristo sa atin.'
            ],
            [
                'question' => 'Sino ang lumikha sa atin at Hari ng ating buhay?',
                'options' => [
                    'Si Hesus ang Kataas-taasan at Makapangyarihang Diyos' => true,
                    'Ang mga anghel' => false,
                    'Ang mga propeta' => false,
                    'Ang mga apostol' => false,
                ],
                'explanation' => 'Si Hesus ang Kataas-taasan at Makapangyarihang Diyos na lumikha sa atin.'
            ],
            [
                'question' => 'Ano ang mangyayari kung tunay tayong magtitiwala kay Kristo bilang Panginoon?',
                'options' => [
                    'Tayo ay pinagkakalooban ng kapangyarihan at kakayahang mamuhay ng ganap' => true,
                    'Tayo ay magiging mayaman' => false,
                    'Tayo ay magiging sikat' => false,
                    'Tayo ay hindi na magkakaproblema' => false,
                ],
                'explanation' => 'Ang pagtitiwala kay Kristo bilang Panginoon ay nagbibigay sa atin ng kapangyarihan at kakayahang mamuhay ng ganap.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson4Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ayon sa Mateo 6:14-15, ano ang kondisyon upang tayo ay patawarin?',
                'options' => [
                    'Kung pinapatawad natin ang mga nagkakasala sa atin' => true,
                    'Kung tayo ay nag-aayuno' => false,
                    'Kung tayo ay nagdarasal ng maraming beses' => false,
                    'Kung tayo ay nagbibigay ng limos' => false,
                ],
                'explanation' => 'Ang pagpapatawad sa iba ay kondisyon upang tayo ay patawarin ng Diyos.'
            ],
            [
                'question' => 'Sino ang unang tao na kailangan nating patawarin?',
                'options' => [
                    'Ang ating sarili' => true,
                    'Ang ating mga magulang' => false,
                    'Ang ating mga kaaway' => false,
                    'Ang ating mga kapatid' => false,
                ],
                'explanation' => 'Maraming tao ang nahihirapang patawarin ang kanilang sarili. Kailangan nating tanggapin ang kapatawaran ng Diyos para sa ating sarili.'
            ],
            [
                'question' => 'Ayon sa Mga Awit 103:12, ano ang ginawa ng Diyos sa ating mga kasalanan?',
                'options' => [
                    'Inalis Niya ito gaya ng kalayuan ng silangan sa kanluran' => true,
                    'Itinago Niya ito' => false,
                    'Nakalimutan Niya ito' => false,
                    'Pinatawad Niya ito' => false,
                ],
                'explanation' => 'Ang Diyos ay nag-alis ng ating mga kasalanan nang lubusan.'
            ],
            [
                'question' => 'Ano ang ipinakita ni Hesus nang Siya ay ipinako sa krus?',
                'options' => [
                    'Ang Kanyang dakilang habag at pagpapatawad' => true,
                    'Ang Kanyang galit' => false,
                    'Ang Kanyang kahinaan' => false,
                    'Ang Kanyang pagdurusa' => false,
                ],
                'explanation' => 'Ipinakita ni Hesus ang Kanyang dakilang habag nang Siya ay nanalangin, "Ama, patawarin Mo sila."'
            ],
            [
                'question' => 'Sino ang ikalawang tao na dapat nating patawarin?',
                'options' => [
                    'Ang miyembro ng ating pamilya' => true,
                    'Ang ating mga kaaway' => false,
                    'Ang ating mga kaibigan' => false,
                    'Ang ating mga kapitbahay' => false,
                ],
                'explanation' => 'Kailangan nating patawarin ang mga miyembro ng ating pamilya at alisin ang lahat ng galit o sama ng loob.'
            ],
            [
                'question' => 'Ano ang mangyayari kung tayo ay may sama ng loob sa Diyos?',
                'options' => [
                    'Hindi tayo makakaranas ng mga himala ng Diyos' => true,
                    'Tayo ay pagpapalain' => false,
                    'Tayo ay magiging matagumpay' => false,
                    'Tayo ay yuyaman' => false,
                ],
                'explanation' => 'Hindi maaaring ikaw ay may galit o sama ng loob sa Diyos at kasabay nito ay umaasa na makakaranas ng mga himala ng Diyos.'
            ],
            [
                'question' => 'Ano ang isang bagong simula kay Kristo?',
                'options' => [
                    'Pagpapanumbalik ng relasyon at pag-aalis ng galit at kapaitan' => true,
                    'Paglimot sa nakaraan' => false,
                    'Pagbabago ng tirahan' => false,
                    'Pagkakaroon ng bagong trabaho' => false,
                ],
                'explanation' => 'Ang bagong simula kay Kristo ay pagpapanumbalik ng relasyon at pag-aalis ng galit at kapaitan.'
            ],
            [
                'question' => 'Ano ang dahilan ng pagpapatawad ng Diyos sa atin?',
                'options' => [
                    'Dahil sa Kanyang biyaya at pag-ibig' => true,
                    'Dahil tayo ay karapat-dapat' => false,
                    'Dahil tayo ay mabubuti' => false,
                    'Dahil tayo ay mayayaman' => false,
                ],
                'explanation' => 'Ang pagpapatawad ng Diyos ay dahil sa Kanyang biyaya at pag-ibig, hindi dahil tayo ay karapat-dapat.'
            ],
            [
                'question' => 'Ano ang dapat nating gawin sa mga taong nakasakit sa atin?',
                'options' => [
                    'Patawarin at ipanalangin sila' => true,
                    'Gantihan sila' => false,
                    'Limutin sila' => false,
                    'Iwasan sila' => false,
                ],
                'explanation' => 'Kailangan nating patawarin ang mga nakasakit sa atin at ipanalangin sila.'
            ],
            [
                'question' => 'Ano ang bunga ng hindi pagpapatawad?',
                'options' => [
                    'Kapaitan at pagkabilanggo ng puso' => true,
                    'Kapayapaan' => false,
                    'Kaganapan' => false,
                    'Tagumpay' => false,
                ],
                'explanation' => 'Ang hindi pagpapatawad ay nagdudulot ng kapaitan at pagkabilanggo ng puso.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson5Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ayon sa Mga Hebreo 10:25, ano ang hindi natin dapat kaligtaan?',
                'options' => [
                    'Ang pagdalo sa ating mga pagtitipon' => true,
                    'Ang pagbabasa ng Biblia' => false,
                    'Ang pag-aayuno' => false,
                    'Ang pagbibigay ng handog' => false,
                ],
                'explanation' => 'Hindi natin dapat kaligtaan ang pagdalo sa ating mga pagtitipon upang magpalakasan ng loob.'
            ],
            [
                'question' => 'Ano ang unang pangunahing bahagi ng pamumuhay ng isang Kristiyano?',
                'options' => [
                    'Devotion o pang-araw-araw na pakikipag-ugnayan sa Salita ng Diyos' => true,
                    'Cell Group' => false,
                    'Sunday Celebration' => false,
                    'PEPSOL Training' => false,
                ],
                'explanation' => 'Ang devotion ay ang pang-araw-araw na pakikipag-ugnayan sa Salita ng Diyos.'
            ],
            [
                'question' => 'Ano ang layunin ng Cell Group?',
                'options' => [
                    'Magkaroon ng pananagutan at suportahan ang isa\'t isa' => true,
                    'Magkaroon ng malaking pagtitipon' => false,
                    'Magdaos ng pagsamba' => false,
                    'Magbigay ng pagsasanay' => false,
                ],
                'explanation' => 'Ang Cell Group ay nagbibigay ng pananagutan at suporta sa isa\'t isa.'
            ],
            [
                'question' => 'Ano ang tawag sa malaking pagtitipon kung saan nagkikita ang lahat ng cell groups?',
                'options' => [
                    'Cell Celebration o Sunday Celebration' => true,
                    'Devotion' => false,
                    'PEPSOL' => false,
                    'Prayer Meeting' => false,
                ],
                'explanation' => 'Ang Cell Celebration ay ang malaking pagtitipon ng lahat ng cell groups.'
            ],
            [
                'question' => 'Ano ang tinutukoy ng PEPSOL training?',
                'options' => [
                    'Pagsasanay para sa pag-unlad at paglago' => true,
                    'Pagsamba' => false,
                    'Pananalangin' => false,
                    'Pagtuturo ng Biblia' => false,
                ],
                'explanation' => 'Ang PEPSOL training ay para sa pag-unlad at paglago ng mga mananampalataya.'
            ],
            [
                'question' => 'Ayon sa 2 Timoteo 2:2, ano ang dapat gawin sa mga natutuhan?',
                'options' => [
                    'Ituro sa mga taong mapagkakatiwalaan at may kakayahang magturo sa iba' => true,
                    'Itago lamang' => false,
                    'Kalimutan' => false,
                    'Isulat at itago' => false,
                ],
                'explanation' => 'Ang mga natutuhan ay dapat ituro sa iba upang magpatuloy ang pagpapalaganap ng ebanghelyo.'
            ],
            [
                'question' => 'Ano ang nagbibigay ng kasaganaan at tagumpay sa pamumuhay ayon sa Josue 1:8-9?',
                'options' => [
                    'Pagbubulay-bulay sa Salita ng Diyos araw at gabi' => true,
                    'Paggawa ng mabubuting gawa' => false,
                    'Pagbibigay ng maraming handog' => false,
                    'Pagdalo sa lahat ng pagtitipon' => false,
                ],
                'explanation' => 'Ang pagbubulay-bulay sa Salita ng Diyos araw at gabi ay nagdudulot ng kasaganaan at tagumpay.'
            ],
            [
                'question' => 'Ano ang apat na pangunahing pagtitipon ng isang Kristiyano?',
                'options' => [
                    'Devotion, Cell Group, Sunday Celebration, PEPSOL Training' => true,
                    'Panalangin, Pag-aayuno, Pagsamba, Pagbibigay' => false,
                    'Biblia, Panalangin, Pagsamba, Paglilingkod' => false,
                    'Pag-aaral, Pagtuturo, Pagsamba, Panalangin' => false,
                ],
                'explanation' => 'Ang apat na pangunahing pagtitipon ay Devotion, Cell Group, Sunday Celebration, at PEPSOL Training.'
            ],
            [
                'question' => 'Bakit kailangan ng isang Kristiyano ang pamumuhay na may mga pagtitipon?',
                'options' => [
                    'Upang magpatuloy sa paglago at magkaroon ng lakas at suporta' => true,
                    'Upang magpakita ng kabanalan' => false,
                    'Upang makilala ng ibang tao' => false,
                    'Upang maging sikat' => false,
                ],
                'explanation' => 'Ang mga pagtitipon ay nagbibigay ng lakas, suporta, at pagkakataon para sa paglago.'
            ],
            [
                'question' => 'Ano ang Gospel Community?',
                'options' => [
                    'Isang lugar para sa paglago at tagumpay sa relasyon sa Diyos at sa ibang tao' => true,
                    'Isang gusali ng simbahan' => false,
                    'Isang paaralan ng Biblia' => false,
                    'Isang organisasyon' => false,
                ],
                'explanation' => 'Ang Gospel Community ay isang lugar kung saan lumalago ang relasyon sa Diyos at sa ibang tao.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson6Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ano ang layunin ng devotion o quiet time?',
                'options' => [
                    'Magkaroon ng malapit at malalim na relasyon sa Diyos' => true,
                    'Magbasa ng maraming aklat' => false,
                    'Magsulat ng diary' => false,
                    'Magrelaks at magpahinga' => false,
                ],
                'explanation' => 'Ang layunin ng devotion ay magkaroon ng malapit at malalim na relasyon sa Diyos.'
            ],
            [
                'question' => 'Ayon sa Jeremias 7:23, ano ang nais ng Diyos para sa Kanyang bayan?',
                'options' => [
                    'Mamuhay sila ayon sa Kanyang mga utos at maging maayos ang kanilang buhay' => true,
                    'Maging mayaman sila' => false,
                    'Maging sikat sila' => false,
                    'Maging malaya sa problema' => false,
                ],
                'explanation' => 'Nais ng Diyos na tayo ay sumunod sa Kanya upang maging maayos ang ating buhay.'
            ],
            [
                'question' => 'Ayon sa Josue 1:8, kailan dapat pagbulay-bulayan ang Salita ng Diyos?',
                'options' => [
                    'Araw at gabi' => true,
                    'Tuwing Linggo lamang' => false,
                    'Kapag may problema' => false,
                    'Kapag nasa simbahan' => false,
                ],
                'explanation' => 'Ang Salita ng Diyos ay dapat pagbulay-bulayan araw at gabi.'
            ],
            [
                'question' => 'Ano ang RHEMA sa paggawa ng devotion?',
                'options' => [
                    'Ang tiyak na Salita ng Diyos para sa iyo sa sandaling iyon' => true,
                    'Ang buong Biblia' => false,
                    'Isang awit ng pagsamba' => false,
                    'Isang panalangin' => false,
                ],
                'explanation' => 'Ang RHEMA ay ang tiyak na Salita ng Diyos para sa iyo sa sandaling iyon.'
            ],
            [
                'question' => 'Ano ang dapat isulat sa isang devotion notebook?',
                'options' => [
                    'Rhema, Reflection, Motivation, at Application' => true,
                    'Mga pangarap lamang' => false,
                    'Mga plano sa buhay' => false,
                    'Mga listahan ng gagawin' => false,
                ],
                'explanation' => 'Ang dapat isulat ay ang Rhema, Reflection, Motivation, at Application.'
            ],
            [
                'question' => 'Bakit kailangan ng tahimik na lugar para sa devotion?',
                'options' => [
                    'Upang makaiwas sa mga gambala at makarinig ng malinaw mula sa Diyos' => true,
                    'Upang hindi makita ng ibang tao' => false,
                    'Upang makatulog' => false,
                    'Upang makapag-isip ng plano' => false,
                ],
                'explanation' => 'Ang tahimik na lugar ay nakakatulong upang makaiwas sa mga gambala at makarinig mula sa Diyos.'
            ],
            [
                'question' => 'Ano ang APPLICATION sa devotion?',
                'options' => [
                    'Pagsasabuhay ng natanggap na kapahayagan mula sa Diyos' => true,
                    'Pagsusulat ng magagandang salita' => false,
                    'Pagbabasa ng maraming kabanata' => false,
                    'Pag-alaala sa mga pangyayari' => false,
                ],
                'explanation' => 'Ang APPLICATION ay ang pagsasabuhay ng natanggap na kapahayagan mula sa Diyos.'
            ],
            [
                'question' => 'Ano ang dapat gawin bago magdevotion?',
                'options' => [
                    'Hingin ang patnubay ng Banal na Espiritu' => true,
                    'Kumain ng marami' => false,
                    'Manood ng TV' => false,
                    'Makipagkwentuhan' => false,
                ],
                'explanation' => 'Dapat hingin ang patnubay ng Banal na Espiritu bago magdevotion.'
            ],
            [
                'question' => 'Ano ang kahalagahan ng pagiging consistent sa devotion?',
                'options' => [
                    'Nagpapatatag ito ng relasyon sa Diyos at nagbibigay ng direksyon sa buhay' => true,
                    'Nakakatulong ito upang maging relihiyoso' => false,
                    'Nagpapakita ito ng kabanalan' => false,
                    'Nakakatulong ito upang makaiwas sa problema' => false,
                ],
                'explanation' => 'Ang pagiging consistent sa devotion ay nagpapatatag ng relasyon sa Diyos at nagbibigay ng direksyon.'
            ],
            [
                'question' => 'Ano ang REFLECTION sa devotion?',
                'options' => [
                    'Pagbubulay-bulay sa Rhema at pag-uugnay nito sa sariling buhay' => true,
                    'Pagsusulat ng mga pangarap' => false,
                    'Pagbabasa ng mga awit' => false,
                    'Pag-alaala sa nakaraan' => false,
                ],
                'explanation' => 'Ang REFLECTION ay ang pagbubulay-bulay sa Rhema at pag-uugnay nito sa sariling buhay.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson7Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ano ang panalangin?',
                'options' => [
                    'Pakikipag-usap at pakikipag-isa sa Diyos' => true,
                    'Pagbasa ng Biblia' => false,
                    'Pagsamba' => false,
                    'Pagtitipon' => false,
                ],
                'explanation' => 'Ang panalangin ay ang pakikipag-usap at pakikipag-isa sa Diyos.'
            ],
            [
                'question' => 'Ayon sa Mateo 7:7-8, ano ang dapat gawin upang makatanggap?',
                'options' => [
                    'Humingi, humanap, at kumatok' => true,
                    'Maghintay lamang' => false,
                    'Magtiis' => false,
                    'Magreklamo' => false,
                ],
                'explanation' => 'Ang humihingi ay tatanggap; ang humahanap ay makakatagpo; ang kumakatok ay pagbubuksan.'
            ],
            [
                'question' => 'Kailan dapat manalangin ayon sa Kasulatan?',
                'options' => [
                    'Manalangin nang tuloy-tuloy' => true,
                    'Tuwing Linggo lamang' => false,
                    'Kapag may problema lamang' => false,
                    'Kapag nasa simbahan lamang' => false,
                ],
                'explanation' => 'Ayon sa 1 Tesalonica 5:17, tayo ay dapat manalangin nang walang tigil.'
            ],
            [
                'question' => 'Sino ang dapat ipanalangin?',
                'options' => [
                    'Lahat ng tao, kasama na ang mga kaaway' => true,
                    'Ang mga kaibigan lamang' => false,
                    'Ang pamilya lamang' => false,
                    'Ang mga lider lamang' => false,
                ],
                'explanation' => 'Dapat nating ipanalangin ang lahat ng tao, kasama na ang ating mga kaaway.'
            ],
            [
                'question' => 'Saan dapat manalangin ayon sa Mateo 6:6?',
                'options' => [
                    'Sa lihim na lugar, sa iyong silid' => true,
                    'Sa lansangan' => false,
                    'Sa palengke' => false,
                    'Sa harap ng maraming tao' => false,
                ],
                'explanation' => 'Dapat tayong manalangin sa lihim na lugar, sa ating silid, upang makita ng Ama sa lihim.'
            ],
            [
                'question' => 'Ano ang dapat na nilalaman ng panalangin?',
                'options' => [
                    'Pagsamba, pagpapasalamat, at paghingi ng tulong sa Diyos' => true,
                    'Mga reklamo lamang' => false,
                    'Mga hinanakit' => false,
                    'Mga hiling para sa sarili lamang' => false,
                ],
                'explanation' => 'Ang panalangin ay dapat maglaman ng pagsamba, pagpapasalamat, at paghingi ng tulong sa Diyos.'
            ],
            [
                'question' => 'Ayon sa Mateo 21:22, ano ang susi upang matanggap ang mga hinihingi sa panalangin?',
                'options' => [
                    'Pananampalataya' => true,
                    'Pag-aayuno' => false,
                    'Pagtitiyaga' => false,
                    'Pagkabanal' => false,
                ],
                'explanation' => 'Ang mga hinihingi sa panalangin ay tatanggapin kung tayo ay nananalig.'
            ],
            [
                'question' => 'Ano ang itinuturo sa atin ng Panalangin ng Panginoon (Lord\'s Prayer)?',
                'options' => [
                    'Ang tamang paraan ng panalangin' => true,
                    'Ang tamang paraan ng pagsamba' => false,
                    'Ang tamang paraan ng pag-aayuno' => false,
                    'Ang tamang paraan ng pagbibigay' => false,
                ],
                'explanation' => 'Ang Panalangin ng Panginoon ay nagtuturo sa atin ng tamang paraan ng panalangin.'
            ],
            [
                'question' => 'Ano ang dapat nating gawin upang mapanatiling malinis ang ating espiritu?',
                'options' => [
                    'Manalangin at lumapit sa Diyos' => true,
                    'Mag-ipon ng kayamanan' => false,
                    'Magtago ng sama ng loob' => false,
                    'Magdahilan' => false,
                ],
                'explanation' => 'Ang panalangin ay naglilinis at nagbibigay ng direksyon sa ating espiritu.'
            ],
            [
                'question' => 'Ayon sa Mga Hebreo 4:16, bakit tayo makakalapit sa Diyos nang may kapanatagan?',
                'options' => [
                    'Dahil tayo ay Kanyang mga anak' => true,
                    'Dahil tayo ay perpekto' => false,
                    'Dahil tayo ay mayayaman' => false,
                    'Dahil tayo ay matatalino' => false,
                ],
                'explanation' => 'Tayo ay makakalapit sa Diyos nang may kapanatagan dahil tayo ay Kanyang mga anak.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson8Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ayon sa Mga Taga-Roma 10:14, bakit kailangan ng mga tao ng mangangaral?',
                'options' => [
                    'Upang marinig nila ang tungkol kay Hesus at manampalataya' => true,
                    'Upang sila ay magkaroon ng kaalaman' => false,
                    'Upang sila ay makapag-aral' => false,
                    'Upang sila ay yumaman' => false,
                ],
                'explanation' => 'Kailangan ng mga tao ng mangangaral upang marinig nila ang tungkol kay Hesus at manampalataya.'
            ],
            [
                'question' => 'Ano ang Great Commission na ibinigay ni Hesus?',
                'options' => [
                    'Gumawa ng mga alagad mula sa lahat ng bansa' => true,
                    'Magtayo ng maraming simbahan' => false,
                    'Mangaral sa isang lugar lamang' => false,
                    'Mag-ipon ng maraming pera' => false,
                ],
                'explanation' => 'Ang Great Commission ay gumawa ng mga alagad mula sa lahat ng bansa.'
            ],
            [
                'question' => 'Ayon sa Mateo 28:19-20, ano ang dapat gawin sa mga bagong alagad?',
                'options' => [
                    'Bautismuhan at turuan silang sumunod kay Hesus' => true,
                    'Iwanan silang mag-isa' => false,
                    'Pabayaan sila' => false,
                    'Hayaan silang magdesisyon para sa sarili' => false,
                ],
                'explanation' => 'Ang mga bagong alagad ay dapat bautismuhan at turuang sumunod kay Hesus.'
            ],
            [
                'question' => 'Ano ang pinakamainam na paraan upang maibahagi ang ebanghelyo?',
                'options' => [
                    'Ibahagi ang iyong sariling kuwento kung paano binago ni Hesus ang iyong buhay' => true,
                    'Mangaral sa maraming tao' => false,
                    'Magbigay ng mga tract' => false,
                    'Makipagdebate' => false,
                ],
                'explanation' => 'Ang pinakamainam na paraan ay ibahagi ang iyong sariling kuwento ng kaligtasan.'
            ],
            [
                'question' => 'Ano ang unang dapat gawin bago ibahagi ang ebanghelyo sa isang tao?',
                'options' => [
                    'Ipanalangin sila' => true,
                    'Makipagdebate' => false,
                    'Pilitin sila' => false,
                    'Hatulan sila' => false,
                ],
                'explanation' => 'Ang unang dapat gawin ay ipanalangin ang mga taong nais mong bahaginan.'
            ],
            [
                'question' => 'Ayon sa Mga Taga-Roma 1:16, bakit hindi ikinahihiya ni Pablo ang Magandang Balita?',
                'options' => [
                    'Sapagkat ito ang kapangyarihan ng Diyos para sa kaligtasan' => true,
                    'Sapagkat ito ay nakakapagpayaman' => false,
                    'Sapagkat ito ay nakakapagpasikat' => false,
                    'Sapagkat ito ay nakakapagbigay ng kapangyarihan' => false,
                ],
                'explanation' => 'Ang Magandang Balita ay ang kapangyarihan ng Diyos para sa kaligtasan ng bawat sumasampalataya.'
            ],
            [
                'question' => 'Ano ang dapat gawin pagkatapos na may tumanggap kay Hesus?',
                'options' => [
                    'Tulungan silang mapatatag sa kanilang bagong pananampalataya' => true,
                    'Iwanan sila' => false,
                    'Hayaan silang mag-isa' => false,
                    'Kalimutan sila' => false,
                ],
                'explanation' => 'Dapat tulungan ang bagong mananampalataya na mapatatag sa kanilang pananampalataya.'
            ],
            [
                'question' => 'Ano ang dapat isama sa pagbabahagi ng iyong kuwento?',
                'options' => [
                    'Ang buhay mo bago si Hesus at kung paano ka Niya binago' => true,
                    'Ang iyong mga tagumpay lamang' => false,
                    'Ang iyong mga problema lamang' => false,
                    'Ang iyong kayamanan' => false,
                ],
                'explanation' => 'Dapat isama ang iyong buhay bago si Hesus at kung paano ka Niya binago.'
            ],
            [
                'question' => 'Ano ang pangako ni Hesus sa Mateo 28:20?',
                'options' => [
                    'Ako\'y laging kasama ninyo hanggang sa katapusan ng panahon' => true,
                    'Bibigyan ko kayo ng kayamanan' => false,
                    'Gagawin ko kayong sikat' => false,
                    'Aalisin ko ang lahat ng inyong problema' => false,
                ],
                'explanation' => 'Si Hesus ay laging kasama ng Kanyang mga tagasunod hanggang sa katapusan ng panahon.'
            ],
            [
                'question' => 'Ano ang dapat gawin upang makalikha ng ugnayan sa mga taong nais mong bahaginan?',
                'options' => [
                    'Tulungan, pagpalain, at paglingkuran sila' => true,
                    'Pilitin sila' => false,
                    'Hatulan sila' => false,
                    'Iwasan sila' => false,
                ],
                'explanation' => 'Dapat tulungan, pagpalain, at paglingkuran ang mga tao upang makalikha ng ugnayan.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson9Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ayon sa 2 Mga Taga-Corinto 10:3-6, paano tayo nakikipaglaban?',
                'options' => [
                    'Gamit ang kapangyarihan ng Diyos na nakakapagpabagsak ng mga kuta' => true,
                    'Gamit ang sandatang makamundo' => false,
                    'Gamit ang karunungan ng tao' => false,
                    'Gamit ang kayamanan' => false,
                ],
                'explanation' => 'Tayo ay nakikipaglaban gamit ang kapangyarihan ng Diyos, hindi ang sandatang makamundo.'
            ],
            [
                'question' => 'Ano ang labanan sa pagitan ng espiritu at ng laman?',
                'options' => [
                    'Ang laman ay nahihilig sa kasalanan habang ang espiritu ay nakahilig sa Diyos' => true,
                    'Ang laman ay malakas' => false,
                    'Ang espiritu ay mahina' => false,
                    'Walang labanan' => false,
                ],
                'explanation' => 'Ang laman ay nahihilig sa kasalanan, ngunit ang espiritu ay nakahilig sa Diyos.'
            ],
            [
                'question' => 'Ayon sa Mga Taga-Galacia 5:22-23, ano ang bunga ng Espiritu?',
                'options' => [
                    'Pag-ibig, kagalakan, kapayapaan, katiyagaan, kabaitan, kabutihan, katapatan, kahinahunan, at pagpipigil sa sarili' => true,
                    'Galit, inggit, at pag-aaway' => false,
                    'Kayamanan at kapangyarihan' => false,
                    'Kasiyahan at aliw' => false,
                ],
                'explanation' => 'Ang bunga ng Espiritu ay pag-ibig, kagalakan, kapayapaan, at iba pang mga birtud.'
            ],
            [
                'question' => 'Ayon sa Juan 14:15, paano natin ipinapakita ang pag-ibig kay Hesus?',
                'options' => [
                    'Sa pamamagitan ng pagsunod sa Kanyang mga utos' => true,
                    'Sa pamamagitan ng pagdarasal' => false,
                    'Sa pamamagitan ng pag-aayuno' => false,
                    'Sa pamamagitan ng pagbibigay' => false,
                ],
                'explanation' => 'Ang pag-ibig kay Hesus ay ipinakikita sa pamamagitan ng pagsunod sa Kanyang mga utos.'
            ],
            [
                'question' => 'Ano ang tatlong mahahalagang bahagi ng pagsunod?',
                'options' => [
                    'Pagsunod sa Salita ng Diyos, sa tinig ng Banal na Espiritu, at pagkakaroon ng kusa at maluwag na kalooban' => true,
                    'Pagsunod sa tradisyon, sa mga lider, at sa kultura' => false,
                    'Pagsunod sa batas, sa pamahalaan, at sa lipunan' => false,
                    'Pagsunod sa magulang, sa guro, at sa boss' => false,
                ],
                'explanation' => 'Ang pagsunod ay binubuo ng pagsunod sa Salita, sa Banal na Espiritu, at sa kusa at maluwag na kalooban.'
            ],
            [
                'question' => 'Ayon sa Lucas 6:46-48, ano ang pundasyon ng matibay na buhay?',
                'options' => [
                    'Pagsunod sa Salita ng Diyos' => true,
                    'Kayamanan' => false,
                    'Karunungan' => false,
                    'Kapangyarihan' => false,
                ],
                'explanation' => 'Ang pagsunod sa Salita ng Diyos ang nagtatayo ng matibay na pundasyon sa panahon ng pagsubok.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "pagbihag ng isipan upang sumunod kay Kristo"?',
                'options' => [
                    'Ang pagpapasailalim ng ating mga kaisipan sa awtoridad ni Kristo' => true,
                    'Ang pagkontrol sa isip ng ibang tao' => false,
                    'Ang paglimot sa sariling kaisipan' => false,
                    'Ang pagsunod sa lahat ng gusto ng iba' => false,
                ],
                'explanation' => 'Ang pagbihag ng isipan ay ang pagpapasailalim ng ating mga kaisipan kay Kristo.'
            ],
            [
                'question' => 'Ayon sa Isaias 1:19-20, ano ang resulta ng pagsunod at pagsuway?',
                'options' => [
                    'Ang pagsunod ay nagdudulot ng pagpapala, ang pagsuway ay nagdudulot ng kapahamakan' => true,
                    'Parehong walang resulta' => false,
                    'Ang pagsuway ay mas mabuti' => false,
                    'Walang pagkakaiba' => false,
                ],
                'explanation' => 'Ang pagsunod ay nagdudulot ng pagpapala, ngunit ang pagsuway ay nagdudulot ng kapahamakan.'
            ],
            [
                'question' => 'Sino ang dapat nating igalang at pakinggan ayon sa aralin?',
                'options' => [
                    'Ang ating mga tagapanguna, magulang, at mga guro/boss' => true,
                    'Ang ating mga kaaway lamang' => false,
                    'Ang mga hindi mananampalataya' => false,
                    'Ang mga mayayaman lamang' => false,
                ],
                'explanation' => 'Dapat igalang at pakinggan ang ating mga tagapanguna, magulang, at mga guro/boss.'
            ],
            [
                'question' => 'Ano ang susi upang mapagtagumpayan ang mga pagsubok sa buhay?',
                'options' => [
                    'Pagsunod at pagpapasakop sa Diyos' => true,
                    'Kayamanan at kapangyarihan' => false,
                    'Karunungan ng tao' => false,
                    'Pagtitiis lamang' => false,
                ],
                'explanation' => 'Ang pagsunod at pagpapasakop sa Diyos ay nagbibigay ng matibay na pundasyon upang mapagtagumpayan ang mga pagsubok.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createLesson10Quiz($quiz)
    {
        $questions = [
            [
                'question' => 'Ayon sa Mga Hebreo 10:24-25, ano ang dapat nating gawin?',
                'options' => [
                    'Huwag kaligtaan ang pagdalo sa mga pagtitipon at magpalakasan ng loob' => true,
                    'Mag-isa na lamang' => false,
                    'Umiwas sa mga pagtitipon' => false,
                    'Magtago sa simbahan' => false,
                ],
                'explanation' => 'Hindi natin dapat kaligtaan ang pagdalo sa mga pagtitipon at dapat tayong magpalakasan ng loob.'
            ],
            [
                'question' => 'Ano ang iglesia ayon sa aralin?',
                'options' => [
                    'Isang espirituwal na pamilya kung saan nananahan ang presensya ng Diyos' => true,
                    'Isang gusali lamang' => false,
                    'Isang organisasyon' => false,
                    'Isang paaralan' => false,
                ],
                'explanation' => 'Ang iglesia ay isang espirituwal na pamilya, hindi lamang isang gusali.'
            ],
            [
                'question' => 'Ano ang tatlong katangian ng pamayanan ni Kristo?',
                'options' => [
                    'Pamayanang sumasamba, naglilingkod, at mapagmahal' => true,
                    'Pamayanang mayaman, makapangyarihan, at sikat' => false,
                    'Pamayanang relihiyoso, tradisyunal, at konserbatibo' => false,
                    'Pamayanang malaya, masaya, at walang problema' => false,
                ],
                'explanation' => 'Ang pamayanan ni Kristo ay sumasamba, naglilingkod, at mapagmahal.'
            ],
            [
                'question' => 'Ayon sa Mateo 20:26, paano nagiging dakila ang isang tao?',
                'options' => [
                    'Sa pamamagitan ng pagiging lingkod sa iba' => true,
                    'Sa pamamagitan ng pagkakaroon ng kapangyarihan' => false,
                    'Sa pamamagitan ng pagiging mayaman' => false,
                    'Sa pamamagitan ng pagiging sikat' => false,
                ],
                'explanation' => 'Ang pagiging dakila ay sa pamamagitan ng pagiging lingkod sa iba.'
            ],
            [
                'question' => 'Ayon sa Mga Taga-Roma 12:1-2, ano ang karapat-dapat na pagsamba?',
                'options' => [
                    'Ang ialay ang sarili bilang handog na buhay, banal at kalugud-lugod sa Diyos' => true,
                    'Ang magbigay ng maraming pera' => false,
                    'Ang umawit ng maraming awit' => false,
                    'Ang magtayo ng magandang gusali' => false,
                ],
                'explanation' => 'Ang karapat-dapat na pagsamba ay ang pag-aalay ng sarili sa Diyos.'
            ],
            [
                'question' => 'Ano ang mga espirituwal na kaloob ayon sa Mga Taga-Roma 12:6-8?',
                'options' => [
                    'Mga natatanging kakayahang ibinigay ng Diyos upang maglingkod' => true,
                    'Mga talento lamang' => false,
                    'Mga kayamanan' => false,
                    'Mga posisyon sa lipunan' => false,
                ],
                'explanation' => 'Ang mga espirituwal na kaloob ay natatanging kakayahang ibinigay ng Diyos para sa paglilingkod.'
            ],
            [
                'question' => 'Bakit kailangan ng isang Kristiyano ang pamayanan (community)?',
                'options' => [
                    'Upang magkaroon ng suporta, paglago, at maging katulad ni Kristo' => true,
                    'Upang magkaroon ng maraming kaibigan' => false,
                    'Upang maging sikat' => false,
                    'Upang magkaroon ng negosyo' => false,
                ],
                'explanation' => 'Ang pamayanan ay nagbibigay ng suporta, paglago, at pagiging katulad ni Kristo.'
            ],
            [
                'question' => 'Ano ang layunin ng mga espirituwal na kaloob?',
                'options' => [
                    'Paglilingkod sa isa\'t isa at pagpapalago ng iglesia' => true,
                    'Pagpapayaman ng sarili' => false,
                    'Pagpapasikat ng sarili' => false,
                    'Pangongolekta ng kayamanan' => false,
                ],
                'explanation' => 'Ang mga espirituwal na kaloob ay para sa paglilingkod at pagpapalago ng iglesia.'
            ],
            [
                'question' => 'Ano ang ibig sabihin ng "pamayanang mapagmahal"?',
                'options' => [
                    'Isang pamayanan kung saan ang pag-ibig ang sentro ng relasyon' => true,
                    'Isang pamayanan na laging masaya' => false,
                    'Isang pamayanan na walang problema' => false,
                    'Isang pamayanan na mayayaman' => false,
                ],
                'explanation' => 'Ang pamayanang mapagmahal ay kung saan ang pag-ibig ang sentro ng relasyon.'
            ],
            [
                'question' => 'Ano ang dapat nating ituring ang iglesia?',
                'options' => [
                    'Isang pamilya na nakatalaga upang tulungan tayong mailabas ang pinakamainam sa atin' => true,
                    'Isang negosyo' => false,
                    'Isang organisasyon' => false,
                    'Isang gusali' => false,
                ],
                'explanation' => 'Ang iglesia ay isang pamilya na tumutulong sa atin na mailabas ang pinakamainam sa atin.'
            ],
        ];

        $this->createQuestions($quiz, $questions);
    }

    private function createQuestions($quiz, $questions)
    {
        foreach ($questions as $qIndex => $qData) {
            $question = PepsolQuestion::create([
                'pepsol_quiz_id' => $quiz->id,
                'question_text' => $qData['question'],
                'explanation' => $qData['explanation'],
                'points' => 1,
                'sort_order' => $qIndex + 1,
            ]);

            foreach ($qData['options'] as $optionText => $isCorrect) {
                PepsolQuestionOption::create([
                    'pepsol_question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => $isCorrect,
                    'sort_order' => count($qData['options']),
                ]);
            }
        }
    }
}
