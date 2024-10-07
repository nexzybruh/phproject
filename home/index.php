<?php
session_start(); // Certifique-se de iniciar a sessão
include '../include/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

$query = "SELECT * FROM bases";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn));
}

$bases = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FindX Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/style.css">
    <script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <style>
        body {
            background-color: #15181D; 
            font-family: 'IBM Plex Sans', sans-serif;
            color: #fff;
        }
        .sidebar {
            width: 250px;
            background: rgba(0,191,251,0); 
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #e9e9e9;
            color: #15181D;
        }
        .main-content {
            margin-left: 270px; 
            padding: 20px;
        }
        .dashboard-section {
            padding: 60px 0;
        }
        .dashboard-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2em;
        }
        .dashboard-cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .dashboard-card {
            background: #1e232b;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 10px;
            flex: 1 0 30%;
            text-align: center;
            transition: transform 0.3s;
            border: 1px solid rgba(0, 191, 251, 0.5);
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
        .dashboard-card img {
            width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
            border-radius: 8px;
        }
        .toggle-menu {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(0,191,251,0);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 1100;
        }
        @media (max-width: 768px) {
            .sidebar {
                background: rgba(0,191,251,1);
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0; 
            }
            .toggle-menu {
                display: block; 
            }
            .dashboard-cards {
                flex-direction: column; // Quebrar linha em telas menores
                align-items: center;
            }
            .dashboard-card {
                flex: 1 0 90%; // Usar quase toda a largura em dispositivos móveis
                margin-bottom: 20px; // Espaçamento entre as cartas
            }
        }
    </style>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
                                <img class="header-logo-image" src="../dist/images/logo.svg" alt="Logo FindX">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <button class="toggle-menu" onclick="toggleSidebar()"><img class="header-logo-image" src="../dist/images/logo.svg" alt="Logo FindX"></button>

        <div class="sidebar" id="sidebar">
            <h2>Menu</h2>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?></p>
            <a href="dashboard.html">Dashboard</a>
            <a href="consultas.html">Consultas</a>
            <a href="usuarios.html">Usuários</a>
            <a href="configuracoes.html">Configurações</a>
            <a href="logout.html">Sair</a>
        </div>

        <div class="main-content">
            <section class="hero" id="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hro-title mt-0">FindX Dashboard</h1>
                            <p class="hero-paragraph">Gerencie suas consultas de forma eficiente.</p>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                function toggleSidebar() {
                    const sidebar = document.getElementById('sidebar');
                    sidebar.classList.toggle('open');
                }
            </script>

            <section class="dashboard-section">
                <div class="container cta-inner section-inner">
                    <h2 class="dashboard-title">Bem-vindo à sua Dashboard</h2>
                    <br>
                    <div class="dashboard-cards">
                        <?php foreach ($bases as $base): ?>
                            <div class="dashboard-card">
                                <img src="<?php echo htmlspecialchars($base['url']); ?>" alt="<?php echo htmlspecialchars($base['name']); ?>">
                                <h3><?php echo htmlspecialchars($base['name']); ?></h3>
                                <p><?php echo htmlspecialchars($base['descg']); ?></p>
                                <a href="<?php echo htmlspecialchars($base['url']); ?>" target="_blank" class="button button-primary">Visitar</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="cta section">
                <div class="container">
                    <div class="cta-inner section-inner">
                        <h3 class="section-title mt-0">Precisa de Ajuda?</h3>
                        <div class="cta-cta">
                            <a class="button button-primary button-wide-mobile" href="https://t.me/sync_data">Entre em Contato</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="#">
                            <img class="header-logo-image" src="../dist/images/logo.svg" alt="Logo FindX">
                        </a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li><a href="https://t.me/sync_data">Contato</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                        <li><a href="#">Termos de Uso</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    
    <script src="../dist/js/main.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
