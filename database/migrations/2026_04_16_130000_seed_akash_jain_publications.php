<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $publications = [
            '<strong>Jain A</strong>, Montorfano M, Freeman P, Jose J, Da Costa Mj M, Abdurashid M, Gunasekaran S, Nissen H, Martin P, Seth A, et al. Four-year multicentre experience with the Myval transcatheter heart valve in Mitral, Tricuspid, and Pulmonary positions: durability and hemodynamic outcomes. <em>Asia Intervention</em>, 2026.',
            'Amat-Santos IJ, Real C, Galán-Arriola C, Diz-Díaz J, Párraga R, Pérez-Camargo D, Stepanenko A, Lujan-Rodríguez F, García-Gómez M, Filgueiras-Rama D, Pereda D, Fernández-Jiménez R, García-Álvarez A, <strong>Jain A</strong>, Pensotti F, San Román JA, Ibanez B. Transcatheter aortic valve-in-mechanical valve replacement: a first-in-human study. <em>Eur Heart J</em>. 2026 Jan 30:ehag019. PMID: 41614684.',
            'Pensotti F, <strong>Jain A</strong>, Ruiz J, García Gómez M, Sztejfman M, Wang Y, Campo Prieto A, Serrador Frutos A, Amat Santos IJ. Initial Use of Vitaflow for Single-Operator TAVR: A First Look. <em>J Am Coll Cardiol Intv</em>. 2026 Mar, 19 (5_Suppl) S68.',
            '<strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Gunasekaran S, Mussayev A, García-Gómez M, Fernandez-Cordón C, Campo A, Rodriguez M, Carrasco-Moraleja M, Román AS, Amat-Santos IJ. Comparison of Self-Expandable Acurate Neo-2 and Balloon-Expandable Myval Transcatheter Heart Valves at 4-Year Follow-Up. <em>Catheter Cardiovasc Interv</em>. 2025 Jul 23. PMID: 40702771.',
            '<strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Sengottuvelu G, Abdurashid M, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Carrasco-Moraleja M, San Román A, Amat-Santos IJ. Four-year durability of the Myval balloon-expandable transcatheter aortic valve. <em>EuroIntervention</em>. 2025 Jul 7;21(13):e758-e765. PMID: 40627005.',
            'Jain S, Reddy TS, Patil RS, <strong>Jain A</strong> (corresponding author). Clinical profile and gender variances among premature coronary artery disease cases undergoing percutaneous coronary intervention: A retrospective analysis. <em>J Indian Coll Cardiol</em>. January 2026. DOI: 10.4103/jicc.jicc_2_25.',
            'Pensotti F, Garnacho LJ, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Zuñiga M, Sandín-Fuentes M, Campo A, Cortés-Villar C, Blasco S, Llamas-Fernández L, Campillo S, San Román AJ, Amat-Santos IJ. Device console programming in patients undergoing TAVI with preexisting cardiac implantable electronic devices: a practical guide. <em>REC Interv Cardiol</em>. 2025.',
            'Pensotti F, Garcia-Gomez M, <strong>Jain A</strong>, Rodriguez M, Zuniga M, Jorge C, Sanz-Sanchez J, Regueiro A, Occhipinti G, San Roman A, Amat Santos I. Leaflet Modification for TAVR at high risk of coronary obstruction: A Minimalist Approach. <em>PCR London Valves</em> 2025.',
            'García Gómez M, Assaf S, Lelasi A, De Brahi JP, Pan Ossorio M, Serra García V, Van Royen N, Bhaskaran J, Sengottuvelu G, Sândoli De Brito F, Martín P, Dager A, Sarnago Cebada F, Pensotti F, <strong>Jain A</strong>, San Roman A, Amat Santos IJ. Outcomes of a balloon-expandable transcatheter heart valve for the treatment of aortic regurgitation. <em>PCR London Valves</em> 2025.',
            'Pensotti F, Wang Y, Sztejfman M, Garcia-Gomez M, <strong>Jain A</strong>, Rodriguez M, Zuniga-Luna M, Serrador A, San Roman A, Ruiz Ruiz J, Gomez I, Campillo S, Vallinas Hernandez S, Amat-Santos I. Single-Operator TAVI with an Automatic Release Device: Early Multicenter Experience. <em>PCR London Valves</em> 2025.',
            'Amat-Santos IJ, Real C, <strong>Jain A</strong>, Galan Arriola C, Diz-Diaz J, Perez-Camargo D, Stepanenko A, Pereda D, García-Alvarez A, Pensotti F, García-Gomez M, San Román JA, Ibanez B. Transcatheter aortic valve-in-mechanical valve replacement: A preclinical and first-in-human study. <em>PCR London Valves</em> 2025.',
            'Amat-Santos I, Gómez M, Pensotti F, <strong>Jain A</strong>, Rodriguez M, Chavarria J, Rocha Almeida A, Piñel S, Serrador AM, Gomez-Salvador I, San Roman JA. TCT-730 Leaflet Modification Without General Anesthesia or TEE in High-Risk TAVR: A Conscious Sedation Approach Using BASILICA and UNICORN. <em>JACC</em>. 2025 Oct, 86 (17_Suppl) B318–B319.',
            'Pensotti F, Rodriguez M, <strong>Jain A</strong>, Garcia Gomez M, Amat Santos IJ. TCT-6 Initial Use of VitaFlow for Single-Operator TAVR: A First Look. <em>JACC</em>. 2025 Oct, 86 (17_Suppl) B7.',
            'Amat Santos IJ, García Gómez M, Pan Álvarez-Osorio M, Peral Disdier V, Serruys PW, Baumbach A, <strong>Jain A</strong>, Martin P, Fernández Cordón C, Pensotti F, Rodriguez M, Baladrón Zorita C. Randomized non-inferiority comparison of one-year outcomes of the Myval transcatheter heart valve series with contemporary valves (Sapien and Evolut series) in symptomatic severe native aortic stenosis: the LANDMARK study. <em>SEC Spain</em> 2025.',
            '<strong>Jain A</strong>, Martín Lorenzo P, Pensotti F, García-Gómez M, Rodriguez M, Ruiz Ruiz J, Campo A, Alañon A, Serrador Frutos, Blasco Turrión S, Gomez I, Carrasco Moraleja M, San Román AJ, Amat Santos IJ. Four-year durability of transcatheter implantation of a new aortic valve prosthesis in mitral, tricuspid, and pulmonary locations. <em>SEC Spain</em> 2025.',
            'Llamas Fernandez L, Pinilla Garcia D, Sevilla Ruiz T, Sierra Pallares J, Vallinas Hernandez S, Campillo de Blas S, Garcia Gomez M, <strong>Jain A</strong>, Criado Martín J, Varas Marcos I, San Román AJ, Amat Santos IJ, Baladrón Zorita C. Impact of transcatheter aortic valve implantation height on hemodynamic flow: a computational fluid dynamics study. <em>SEC</em> 2025.',
            '<strong>Jain A</strong>, García-Gómez M, Rodríguez M, Verstraeten L, Vogelaar J, Amat-Santos IJ. Usability and accuracy of a cloud-based sizing software for left atrial appendage closure. <em>REC Interv Cardiol</em>. 2025. DOI: 10.24875/RECICE.M25000536.',
            'Fernández-Cordón C, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Serrador Frutos AM, Campo Prieto A, Gutiérrez H, Cortés Villar C, Blasco Turrión S, San Román A, Amat-Santos IJ. Transcatheter aortic valve-in-valve implantation inside a degenerated sutureless bioprosthesis. <em>EuroIntervention Images</em>. 2025.',
            'Fernández-Cordón C, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Serrador Frutos AM, Campo Prieto A, Cortés C, Blasco-Turrión S, San Román JA, Amat-Santos IJ. Left Ventricle Wire Loss During TAVR: How to Solve it Through Antegrade and Retrograde Approach. <em>JACC Case Rep</em>. 2025 Jun 18;30(15):103758. PMID: 40541354.',
            'García-Gómez M, Martin P, Moreno R, Nombela-Franco L, Bedogni F, Montorfano M, Egred M, Teles R, Fernandez-Cordon C, <strong>Jain A</strong>, Rodriguez M, Amat-Santos I. Matched comparison between Sapien-3 Ultra Resilia and Myval Octacor balloon-expandable valves. <em>EuroPCR</em> 2025.',
            'Rodriguez M, Fernandez-Cordon C, García-Gómez M, <strong>Jain A</strong>, Campo A, Serrador A, Cortes Villar C, San Roman A, Gomez I, Amat-Santos IJ. Initial Experience with the VitaFlow Valve as a single-operator procedure. <em>EuroPCR</em> 2025.',
            '<strong>Jain A</strong>, Montorfan M, Jose J, Montenegro M, Abdurashid M, Gunasekaran S, Nissen H, Martin P, Seth A, Stambuk K, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Campo A, Amat-Santos I. Four-years durability of a novel balloon-expandable transcatheter valve in extra-aortic positions. <em>EuroPCR</em> 2025.',
            'Ruiz Ruiz J, <strong>Jain A</strong>, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Real C, Cortés Villar C, Carnicero D, Carrasco Moraleja M, San Román A, Ibañez B, Amat-Santos I. Exploring the need of transcatheter valve replacement within mechanical aortic prostheses. <em>EuroPCR</em> 2025.',
            'Llamas-Fernández L, Pinilla-García D, Sevilla-Ruiz T, Sierra-Pallares J, Vallinas-Hernández S, Campillo S, García-Gómez M, <strong>Jain A</strong>, San-Román JA, Amat-Santos IJ, Baladrón-Zorita C. Impact of transcatheter aortic valve implant height on haemodynamic flow. <em>EuroPCR</em> 2025.',
            'Fernández-Cordón C, Brilakis ES, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Cortés-Villar C, Campo-Prieto A, Serrador A, Gutiérrez H, Blasco-Turrión S, Scorpiglione L, Llamas-Fernández L, San Roman JA, Amat Santos IJ. Calcified nodules in the coronary arteries: systematic review on incidence and percutaneous coronary intervention outcomes. <em>Revista Española de Cardiología (English ed)</em>. 2025.',
            'Amat-Santos IJ, <strong>Jain A</strong>. Gone long, not wrong: BioMime Morph and a tale of coronary ambition. <em>AsiaIntervention</em>. 2025 Mar 20;11(1):10-11. PMID: 40114733; PMCID: PMC11905109.',
            'García Gómez M, Fernández Cordón C, <strong>Jain A</strong>, Serrador Frutos A, Gutiérrez García H, Campo Prieto A, Cortés Villar C, Blasco Turrión S, San Román JA, Amat Santos IJ. Four-year durability of a novel balloon expandable TAVI system (late-breaking trial). <em>PCR London Valves</em> 2024.',
            'García Gómez M, Fernández Cordón C, <strong>Jain A</strong>, et al. Novel balloon expandable valve: systematic review of aortic, mitral, tricuspid and pulmonary uses. <em>PCR London Valves</em> 2024.',
            '<strong>Jain A</strong>, García-Gomez M, Gutiérrez H, Fernandez-Cordon C, Rodriguez M, Revilla A, Gomez I, Verstraeten L, Vogelaar J, Amat-Santos IJ. Accuracy of two different softwares for sizing LAA closure devices. <em>PCR London Valves</em> 2024.',
            '<strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Sengottuvelu G, Abdurashid M, García-Gómez M, Fernandez-Cordón C, Rodriguez M, San Román JA, Gomez I, Amat-Santos IJ. Comparison of a self-expandable and a novel balloon expandable device at long-term. <em>PCR London Valves</em> 2024.',
            '<strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Garcia-Gomez M, Fernandez Cordon C, Campo Prieto A, Amat-Santos I. TCT-928 Comparison of the Self-Expandable Acurate Neo 2 and the New Balloon-Expandable Myval Series Transcatheter Heart Valve at 4-Year Follow-Up. <em>JACC</em>. 2024 Oct, 84 (18_Suppl) B391–B392.',
            'Cordon C, Garcia-Gomez M, <strong>Jain A</strong>, Blasco-Turrion S, Campo Prieto A, Cortes Villar C, Amat-Santos I. TCT-374 Calcified Nodules in the Coronary Arteries: Systematic Review on Incidence and Percutaneous Coronary Intervention Outcomes. <em>JACC</em>. 2024 Oct, 84 (18_Suppl) B101.',
            'García-Gómez M, Fernández-Cordón C, González-Gutiérrez JC, Serrador A, Campo A, Cortés Villar C, Blasco Turrión S, Aristizábal C, Peral Oliveira J, Stepanenko A, González Arribas M, Scorpiglione L, <strong>Jain A</strong>, Carnicero Martínez D, San Román JA, Amat-Santos IJ. The novel balloon-expandable Myval transcatheter heart valve: systematic review of aortic, mitral, tricuspid and pulmonary indications. <em>Rev Esp Cardiol (Engl Ed)</em>. 2024 Oct. PMID: 39395599.',
            '<strong>Jain A</strong>, Kharge J, Manjunath CN, Shrimanth YS. Case Report: Quadricuspid Aortic Valve. <em>J Invasive Cardiol</em>. 2023 Aug 28.',
            '<strong>Jain A</strong>, Marimuthu V, Alur N. The Mechanical Prosthetic Valve Thrombosis after ChAdOx1-nCoV-19 Vaccination: A Case Report. <em>Indian Heart Journal</em>. 2022.',
            '<strong>Jain A</strong>, Tripathi BK. A Study of Hyperhomocysteinemia as a Risk Factor for Acute Myocardial Infarction. <em>Journal of the Association of Physicians of India (JAPI)</em>.',
            'Kumar R, Umashankar U, Punia VPC, Kabi BC, Singh BG, Khosla H, <strong>Jain A</strong>. Vitamin-D Status in metabolic syndrome and its correlation with different parameters of metabolic syndrome. <em>JMSCR</em>. 2018.',
            'Arya R, Rajvanshi P, Ngullie B, Das D, Arora R, <strong>Jain A</strong>. A Case of Acute Motor-Sensory Axonal Neuropathy after Enteric Fever. <em>JMSCR</em>. 2018.',
        ];

        $items = array_map(fn ($html) => ['html' => $html], $publications);

        $now = now();

        DB::table('sections')->updateOrInsert(
            ['key' => 'akash.publications_list'],
            [
                'page' => 'akash-jain',
                'title' => 'Publications List',
                'meta' => json_encode(['items' => $items]),
                'is_active' => true,
                'sort_order' => 0,
                'updated_at' => $now,
                'created_at' => $now,
            ],
        );
    }

    public function down(): void
    {
        DB::table('sections')->where('key', 'akash.publications_list')->delete();
    }
};
