<?php
include ("barra.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            height: 100px;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        .container {
            max-width: 80%;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #333;
        }

        l1 {
            display: block;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        strong {
            color: #333;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">Doar sangue salva vidas</h1>

<main>
    <div class="container">
        <br>
        <h1>Por que criamos esse site?</h1>
        <p>Nós acreditamos no poder da solidariedade e no impacto positivo que cada doação pode proporcionar. Nosso objetivo é tornar o processo de agendar uma doação mais simples, acessível e eficiente, conectando doadores a bancos de sangue e centros de coleta em todo o país. Ao doar sangue, você está salvando vidas e fortalecendo sua comunidade. Junte-se a nós nesta missão de empatia e generosidade. Seu gesto é essencial e juntos, podemos fazer a diferença!</p>

        <h1>Critérios para Doação de Sangue</h1>
        <ul>
            <li>Apresentar documento original com foto.</li>
            <li>Ter entre 16 e 69 anos. Para maiores de 60 anos, é necessário já ter realizado pelo menos uma doação antes dos 60 anos, 11 meses e 29 dias. Menores de idade (16 e 17 anos) devem estar acompanhados pelo responsável legal. (Consultar as regras específicas)</li>
            <li>Estar em boas condições de saúde.</li>
            <li>Pesar mais de 50 kg</li>
            <li>Respeitar o intervalo entre doações: pelo menos 60 dias para homens (até 4 doações por ano) e 90 dias para mulheres (até 3 doações por ano).</li>
            <li>Não ter apresentado sintomas como gripe, febre ou diarreia nos últimos 14 dias.</li>
            <li>Não estar em jejum, mas evitar alimentos gordurosos nas 3 horas que antecedem a doação.</li>
            <li>Não ter recebido transfusão de sangue ou derivados no último ano.</li>
        </ul>

        <p>Os critérios para liberação ou impedimento do doador estão descritos na <strong><span style="color: red;">Portaria nº 158/2016 do Ministério da Saúde.</span></strong> Situações não especificadas na portaria serão avaliadas por um médico e/ou enfermeiro no momento da triagem clínica.</p>

        <p>Abaixo, estão as causas mais comuns de impedimento, lembrando que estes itens não são os únicos:</p>

        <h3>Fatores de Impedimento Temporário para Doação de Sangue:</h3>
        <ul>
            <li>Covid-19: Pessoas com diagnóstico positivo ou suspeita de Covid-19 podem doar 10 dias após a cura.</li>
            <li>Vacinas contra Covid-19: Após as vacinas Coronavac, Sinovac, Butantan e Covaxin, deve-se aguardar 48 horas para doar. Para as demais vacinas, o prazo é de 7 dias.</li>
            <li>Gravidez e Parto: Impedimento até 3 meses após o parto.</li>
            <li>Aborto: Impedimento de até 3 meses após o aborto.</li>
            <li>Amamentação: Impedimento se o parto ocorreu há menos de 12 meses.</li>
            <li>Relação Sexual: Impedimento para quem teve relação sexual com novo(a) parceiro(a) nos últimos 6 meses.</li>
            <li>Infecções, Alergias ou Ferimentos Recentes: Informe-se sobre possíveis impedimentos.</li>
            <li>Medicamentos: Uso contínuo ou recente de medicamentos pode impedir a doação (informe-se).</li>
            <li>Bebidas Alcoólicas: Impedimento para quem consumiu álcool nas 12 horas anteriores à doação.</li>
            <li>Drogas Ilícitas: Informe-se, pois o impedimento pode ser temporário ou definitivo, dependendo da substância.</li>
            <li>Tratamentos Odontológicos Recentes: Informe-se sobre possíveis restrições.</li>
            <li>Cirurgias ou Exames Endoscópicos: Informe-se sobre o tempo de espera necessário.</li>
            <li>Vacinação: Informe-se sobre os prazos para diferentes vacinas.</li>
            <li>Tatuagem, Piercing ou Maquiagem Definitiva: Impedimento se realizados nos últimos 6 meses.</li>
            <li>Viagem Internacional: Informe-se se viajou para o exterior nos últimos 15 dias.</li>
            <li>Viagem para Áreas Endêmicas de Malária: Impedimento para quem visitou essas áreas nos últimos 12 meses.</li>
            <li>Tuberculose Pulmonar: Impedimento até 5 anos após a cura.</li>
        </ul>

        <h3>Fatores de Impedimento Definitivo para Doação de Sangue:</h3>
        <ul>
            <li>Ter ou ter tido histórico das seguintes infecções: HIV, Doença de Chagas, Tuberculose extrapulmonar, Hepatite após os 11 anos de idade (observação: quem teve Hepatite A pode doar).</li>
            <li>Ser dependente de insulina.</li>
            <li> Apresentar cardiopatias (doenças cardíacas).</li>
            <li>Ter realizado tratamento oncológico (radioterapia e/ou quimioterapia).</li>
            <li>Possuir piercing na língua e/ou na região genital durante o uso e até 1 ano após a remoção.</li>
        </ul>
        <br>
        <h1>Informações Importantes</h1>
        <p><strong>Documentos de Identificação:</strong> Para realizar a doação, é obrigatório apresentar um documento oficial com foto que contenha o nome completo, data de nascimento, nome da mãe, e número do RG e/ou CPF.</p>
        <p>Documentos aceitos:</p>
        <ul>
          <li>Carteira de Identidade</li>
          <li>Carteira Nacional de Habilitação</li>
          <li>Passaporte</li>
          <li>Registro Nacional de Estrangeiro.</li>
          <li>Carteira de Conselho Profissional ou Carteira de Identidade Militar: aceitos desde que contenham as informações acima.</li>
          <li>Documentos digitais: aceitos com as informações acima e abertos no momento do cadastro.</li>
          <li>Fotocópia autenticada de documento oficial: aceita se a foto e as informações estiverem legíveis e permitirem a identificação do portador.</li>
          <strong><li>Não serão aceitos prints de tela</li></strong>
        </ul>

        <h1>Contato</h1>

        <p>Telefone: (41) 4002 - 8922</p>
        <p>Telefone: (41) 9 6666 - 0000</p>
        <br>
        <p><Strong>E-mail:</strong>            doaçãodesangue@gmail.com</p>

       
      
    </div>
</main>
</body>
</html>
