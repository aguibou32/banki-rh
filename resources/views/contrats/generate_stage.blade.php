<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1 style="  text-align: center;
    border: 3px solid black; "> CONTRAT DE STAGE</h1>

    <p><strong>ENTRE-LES SOUSSIGNES :</strong></p>

    <p><strong>BANKITRUCK SAS</strong> au capital de cinquante millions de Francs Guinéens (50. 000 000 GNF),
        RCCM/GNTCC.2021. A.15 584/KAL/0515.584 dont le siège social est situé à Kippé -C/Ratoma, est représentée par
        Monsieur Mamadou BAH agissant en qualité de Directeur General.</p>

    <p><strong> D'UNE PART,</strong></p>

    <p><strong>ET</strong></p>

    <p><strong>{{ $employee_name }} {{ $employee_surname }} </strong>, de nationalité
        <strong>{{ $employee_nationality }}</strong>, Né(e) le <b>{{ date('d F, Y', strtotime($employee_dob)) }} </b>.
    </p>

    <p>
        Numéro de téléphone : {{ $employee_phone }}, Imatricule: <b>({{ $employee_matricule }})</b> Numéro du passeport: <b>({{ $employee_id_number }})</b>.
    </p>

    <p><strong> D'AUTRE PART,</strong></p>

    <p>Il a été convenu ce qui suit: </p>
    <p>Article 1 - Projet pédagogique et contenu du stage</p>
    <p>La présente convention règle les rapports de l'entreprise BANKITRUCK avec <strong>{{ $employee_name }}
        {{ $employee_surname }} </strong>, à l'occasion d'apprentissage en qualité de stagiaire {{ $employee_role }} au sein de BANKITRUCK. </p>

    <p>Ce stage a pour objet d’imprégner le/la stagiaire à l’environnement de travail et aux obligations et instructions de son/sa responsable de stage {{ $responsable_name }}, consigné pour une continuité ou une discontinuité des travaux confiés aux apprentis après évaluation et appréciation des apprentis. </p>

    <p>Article 2 - Contenu du stage </p>
    <p>Pendant la durée de son stage, <strong>{{ $employee_name }} {{ $employee_surname }} </strong>,
        exécutera les taches qui lui seront confiées par son/sa responsable de stage. </p>

    <p>Article 3 - Durée, lieu et horaires du stage </p>

    <p>Le présent stage se déroulera du <strong>{{ date('d F, Y', strtotime($debut)) }}</strong> au <strong>{{  date('d F, Y', strtotime($fin)) }}</strong> à Conakry, heure de pause de 13h-30 à 14 h30.</p>

    <p>Les horaires suivis par <strong>{{ $employee_name }} {{ $employee_surname }} </strong>, seront de <strong>{{ $horraire }}</strong> heures par semaines.</p>

    <p>Article 4 - Accueil et encadrement du stage</p>

    <p>Pendant la période de stage, les travaux de <strong>{{ $employee_name }} {{ $employee_surname }} </strong>, seront supervisés par son/sa Responsable de stage {{ $responsable_name }}  </p>

    <p>Article 5 - Indemnisation et remboursement de frais</p>

    <p>Conformément aux dispositions prévues par <em>la convention collective,</em> la gratification versée à <strong>{{ $employee_name }} {{ $employee_surname }} <strong> sera de <strong>{{ $salaire_de_base }} GNF</strong> par mois.</p>

    <p>Article 6 – Non concurrence </p>
    <p><em>{{ $employee_name }} {{ $employee_surname }}, s’interdira de mener des activités concurrentielles à celle   de l’entreprise collaboratrice
            Deux (2) ans après son départ de l’entreprise sous peine de paiement de dommages et intérêts de cinq
            milliards de francs guinéens (5 .000. 000. 000 GNF). </em></p>

    <p>Article 7 - Discipline</p>

    <p>{{ $employee_name }} {{ $employee_surname }}, est soumise aux dispositions du règlement intérieur de
        l’entreprise relativement aux
        prescriptions ou interdictions liées à l’hygiène et la sécurité ainsi qu’aux horaires de travail. </p>

    <p>{{ $employee_name }} {{ $employee_surname }}, s’oblige à prévenir le responsable Hiérarchique de stage en cas d’absence.</p>

    <p>Toute décision de cessation du stage avant la date prévue doit être notifiée dans les meilleurs délais aux autres contractants. </p>

    <p>Article 8 - Clause de confidentialité</p>

    <p>{{ $employee_name }} {{ $employee_surname }}, s’engage à ne pas divulguer les informations <em>(documents, plans, droit d’auteur, stratégies d’entreprise.)</em> dont elle pourra prendre connaissance directement ou indirectement pendant la durée de son stage. Cette obligation subsistera au-delà de cette période.</p>

    <p>L’utilisation par {{ $employee_name }} {{ $employee_surname }} des <em>(documents, études, réalisations,
            procédés de fabrication, etc.)</em>
        Appartenant à l’entreprise BANKITRUCK doit faire l’objet d’une autorisation expresse de Hawa BAH, responsable de
        stage. </p>

    <p>Article 9 - Évaluation du stage </p>

    <p>Au terme du stage, l’entreprise BANKITRUCK établira une attestation de stage comprenant les mentions suivantes
        <em>: date de début et de fin du stage ; activités du stagiaire : observations de tel processus de fabrication, études sur des procédés ou des marchés, sur des modalités d’exécution de tel marché, etc...).</em>
    </p>

    <p>Article 10 - Validation du stage</p>

    <p>Selon les dispositions prises avec l’entreprise initiant la prise en compte de stagiaires, le stage peut être
        validé pour l’obtention du diplôme préparé. Les modalités de validation doivent être en parfaite cohérence avec
        le respect de toutes les instructions et obligations de l’apprenti précitées.</p>

    <p><strong>Fait à Conakry le {{ date('d F, Y', strtotime($created_at)) }}.</strong></p>

    <p>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td>
                    <p>{{ $employee_name }} {{ $employee_surname }} </p>
                    <p><strong> Stagiaire </strong></p>
                </td>
            </tr>
        </tbody>
    </table>
    </p>
    <p>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td> </td>
            </tr>
        </tbody>
    </table>

    ZOGBELEMOU Catherine</p>

    <p><strong> Chargée des Ressources Humaines</strong></p>

    <p> </p>

    <p>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td> </td>
            </tr>
        </tbody>
    </table>

    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td> </td>
            </tr>
        </tbody>
    </table>
    </p>
</body>

</html>
