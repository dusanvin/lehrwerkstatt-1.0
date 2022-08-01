<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $role_id = $this->faker->randomElement([3, 4]);

        $faecher = [
            'Deutsch',
            'Didaktik des Deutschen als Zweitsprache (Erw.)*',
            'Englisch',
            'Ethik (Erw.)*',
            'Französisch',
            'Geographie',
            'Geschichte',
            'Italienisch',
            'Kunst',
            'Mathematik',
            'Musik',
            'Physik',
            'Religionslehre ev.',
            'Religionslehre kath.',
            'Sozialkunde',
            'Spanisch',
            'Sport weiblich',
            'Sport männlich'
        ];

        $landkreise = [
            'Augsburg Stadt',
            'Augsburg Land',
            'Aichach-Friedberg',
            'Dillingen a. d. Donau',
            'Donau-Ries',
            'Günzburg',
            'Kaufbeuren',
            'Kempten',
            'Lindau',
            'Memmingen',
            'Neu-Ulm',
            'Oberallgäu',
            'Ostallgäu',
            'Unterallgäu'
        ];

        $feedback = [1, 2, 3, 4, 5];
        $zutreffend = [1, 2, 3, 4, 5];

        $freiraum = [1, 2, 3];

        $anrede = $this->faker->randomElement(['Herr', 'Frau', 'keine Anrede / divers']);
        if($anrede == 'Herr') {
            $vorname = $this->faker->firstNameMale();
        }
        elseif($anrede == 'Frau') {
            $vorname = $this->faker->firstNameFemale();
        }
        else {
            $vorname = $this->faker->firstName;
        }

        $survey_data = [
            'datenschutz' => ['Ich bestätige, dass ich die oben verlinkten Datenschutzhinweise sowie die datenschutzrechtliche Einwilligungserklärung zur Kenntnis genommen habe, und willige in die Verarbeitung und Speicherung meiner Daten im Rahmen der Lehr:werkstatt ein.'],
            'teilnahmebedingungen' => ['Ich habe die oben verlinkten verbindlichen Teilnahmebedingungen für den Jahrgang 2022/23 zur Kenntnis genommen und akzeptiere sie.'],
            'anrede' => $anrede,
            'vorname' => $vorname,
            'nachname' => $this->faker->lastName,
            'telefonnummer' => $this->faker->randomNumber(5, true),
            'wunschtandem' => $this->faker->firstName.' '.$this->faker->lastName,

            'eigenstaendigkeit' => $this->faker->randomElement($zutreffend),
            'improvisation' => $this->faker->randomElement($zutreffend),
            'freiraum' => $this->faker->randomElement($freiraum),
            'innovationsoffenheit' => $this->faker->randomElement($zutreffend),
            'belastbarkeit' => $this->faker->randomElement($zutreffend),
            'bestaetigung' => ['Mit dem Absenden des Fragebogens bewerben Sie sich verbindlich für die Lehr:werkstatt im Schuljahr 2022/23. Wir suchen eine*n Tandempartner*in für Sie und gehen davon aus, dass Sie definitv teilnehmen möchten. Bitte bestätigen Sie durch Setzen des Häkchens: Ich habe den Hinweis zur Kenntnis genommen und möchte mich verbindlich bewerben.'],

        ];

        $schulart = $this->faker->randomElement(['Grundschule', 'Realschule', 'Gymnasium']);
        $survey_data['schulart'] = $schulart;

        if($schulart == 'Realschule' || $schulart == 'Gymnasium') {
            $survey_data['faecher'] = $this->faker->randomElements($faecher, rand(1, 4));
        }
        if($schulart == 'Grundschule') {
            
        }

        if($role_id == 3) {

            $role = 'Lehr';

            $aufmerksam_geworden_lehr = [
                "Projekthomepage",
                "Universität",
                "Direktorat",
                "Kollegium",
                "Empfehlung durch ehemalige*n Projektteilnehmer*in",
                "Medien",
                "Sonstiges"
            ];
            
            $freue_auf_lehr = [
                "das Umsetzen neuer Ideen zusammen mit meinem Lehr:werker bzw. meiner Lehr:werkerin.",
                "neue Impulse aus der universitären Lehrer*innenbildung. ",
                "die vielfältigen Möglichkeiten, sich gegenseitig Feedback zu geben.",
                "die Kombination von Aus- und Weiterbildung.",
                "den fächer- und schul(art)übergreifenden Austausch mit anderen Lehr:mentor*innen.",
                "die Erfahrung, im Teamteaching zu unterrichten.",
                "mein Mitwirken an der Lehrer*innenausbildung.",
                "die Weiterbildung im Rahmen der Kompetenzworkshops.",
                "die kontinuierliche Zusammenarbeit über ein ganzes Schuljahr hinweg.",
                "die individuellere Förderung meiner Schüler*innen.",
                "die Unterstützung durch meine*n Lehr:werker*in und eine mögliche Entlastung im alltäglichen Schulleben."
            ];

            $survey_data['registrierungscode'] = 'lehrwerkstatt';
            $survey_data['zustimmung_schul'] = ['Hiermit bestätige ich, dass meine Schulleitung mit meiner Teilnahme an der Lehr:werkstatt im Jahrgang 2022/23 einverstanden ist.'];
            $survey_data['name_schul'] = $this->faker->firstName.' '.$this->faker->lastName;
            $survey_data['email_schul'] = $this->faker->email();
            $survey_data['landkreis'] = $this->faker->randomElement($landkreise);
            $survey_data['schulname'] = $this->faker->catchPhrase().' school';
            $survey_data['strasse'] = $this->faker->streetName();
            $survey_data['hausnummer'] = $this->faker->buildingNumber();
            $survey_data['postleitzahl'] = $this->faker->postcode();
            $survey_data['ort'] = $this->faker->city();
            $survey_data['berufserfahrung'] = $this->faker->randomElement([1, 2, 3, 4]);
            $survey_data['feedback_an'] = $this->faker->randomElement($feedback);
            $survey_data['feedback_von'] = $this->faker->randomElement($zutreffend);
            $survey_data['aufmerksam_geworden'] = $this->faker->randomElements($aufmerksam_geworden_lehr, rand(1, count($aufmerksam_geworden_lehr)));
            $survey_data['freue_auf'] = $this->faker->randomElements($freue_auf_lehr, rand(1, count($freue_auf_lehr)));
        }
        if($role_id == 4) {

            $role = 'Stud';

            $praktika = [
                "Orientierungspraktikum",
                "pädagogisch-didaktisches Schulpraktikum",
                "studienbegleitendes Praktikum",
                "zusätzliches studienbegleitendes Praktikum",
                "Betriebspraktikum",
                "Ich habe noch kein Praktikum im Rahmen meines Lehramtsstudiums absolviert."
            ];
            
            $aufmerksam_geworden_stud = [
                "Projekthomepage",
                "Aushang an der Universität",
                "Dozent*in an der Universität",
                "Mailing der Universität",
                "Kommiliton*innen",
                "Empfehlung durch ehemalige*n Projektteilnehmer*in",
                "Informationsveranstaltung",
                "Medien",
                "Sonstiges"
            ];
            
            $freue_auf_stud = [
                "intensive Praxiserfahrung in der Schule zu sammeln.",
                "zusammen mit meinem Lehr:mentor bzw. meiner Lehr:mentorin im Teamteaching zu unterrichten.",
                "mich ohne Notendruck in der Schulwelt zurechtzufinden und schon wertvolle Erfahrungen für das Referendariat zu sammeln.",
                "an Kompetenzworkshops teilzunehmen, in denen ich praxisnahes Wissen für meinen Einsatz in der Schule erwerbe.",
                "meine Praktikumserfahrungen in der Begleitveranstaltung zu reflektieren.",
                "andere Lehr:werker*innen kennenzulernen und mich mit ihnen auszutauschen.",
                "Feedback zu meinem Unterricht und meiner Eignung als Lehrkraft zu erhalten, aber auch Rückmeldungen an meine*n Lehr:mentor*in zu geben.",
                "meinen Berufswunsch unter Realbedingungen zu reflektieren und darauf basierende eine fundierte Berufsentscheidung treffen zu können.",
                "kontinuierlich über ein Schuljahr hinweg zu entdecken, was es heißt Lehrer*in zu sein.",
                "verschiedene Klassen und Jahrgangsstufen über einen längeren Zeitraum kennenzulernen.",
                "Einblicke in die Erstellung von Leistungsnachweisen und deren Korrektur zu erhalten.",
                "von dem guten Betreuungsverhältnis in der Schule und in der Universität zu profitieren.",
                "tiefere Einblicke in den Schulalltag zu bekommen, wie z.B. die Lehrer*innenkonferenz zu besuchen, ",
                "an Wandertagen und Schullandheimfahrten teilzunehmen, Elternsprechtagen beizuwohnen etc."
            ];

            $verkehrsmittel = [
                "Bus/Tram",
                "Bahn",
                "PKW",
                "Fahrrad"
            ];

            $survey_data['fachsemester'] = $this->faker->randomDigitNotNull();
            $survey_data['feedback_von'] = $this->faker->randomElement($feedback);
            $survey_data['feedback_an'] = $this->faker->randomElement($zutreffend);

            if($schulart == 'Realschule' || $schulart == 'Gymnasium') {
                $survey_data['ehem_schulname'] = $this->faker->catchPhrase().' school';
                $survey_data['ehem_schulort'] = $this->faker->city();
            }

            if($schulart == 'Grundschule')
                $survey_data['religionslehre'] =  $this->faker->randomElement(['Ja', 'Nein']);

            $survey_data['landkreise'] = $this->faker->randomElements($landkreise, rand(1, count($landkreise)));;
            $survey_data['verkehrsmittel'] = $this->faker->randomElements($verkehrsmittel, rand(1, count($verkehrsmittel)));
            $survey_data['wunschorte'] = $this->faker->city();
            $survey_data['praktika'] = $this->faker->randomElements($praktika, rand(1, count($praktika)));
            $survey_data['aufmerksam_geworden'] = $this->faker->randomElements($aufmerksam_geworden_stud, rand(1, count($aufmerksam_geworden_stud)));
            $survey_data['freue_auf'] = $this->faker->randomElements($freue_auf_stud, rand(1, count($freue_auf_stud)));
            
            $survey_data['anmerkungen'] = $this->faker->realText();
        }
        return [
            'vorname' => $survey_data['vorname'],
            'nachname' => $survey_data['nachname'],
            'email' => $this->faker->unique()->safeEmail,
            'role' => $role,
            'survey_data' => json_encode($survey_data),
            'valid' => true,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $role_id = $this->faker->randomElement([3, 4]);
            if($user->role == 'Lehr') {
                $role_id = 3;
            }
            if($user->role == 'Stud') {
                $role_id = 4;
            }
            DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$role_id, 'App\Models\User', $user->id]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
