<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<header class="header">
    <nav class="nav navbar navbar-expand-lg">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="/Assets/logo.png" alt="Logo" class="logo me-2"/>
        </a>
        <button class="navbar-toggler" type="button" aria-label="Menu openen" onclick="document.getElementById('navLinks').classList.toggle('show');">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav-links navbar-nav ms-auto" id="navLinks">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="producten.php">Producten</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Prijzen</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item d-flex align-items-center">
                <a href="cart.php" class="nav-link p-0 me-2">
                    <button class="cart-btn" id="cartBtn" style="background: none; border: none; position: relative;">
                        <i class="bi bi-cart" style="font-size: 1.7rem;"></i>
                        <span id="cartCount" style="position: absolute; top: -6px; right: -8px; background: #bfa046; color: #fff; border-radius: 50%; font-size: 0.85rem; padding: 2px 7px; min-width: 22px; text-align: center;">0</span>
                    </button>
                </a>
                <button class="reserveren ms-2" onclick="location.href='reserveren.php'">Reserveren</button>
            </li>
        </ul>
    </nav>
</header>
    <br><br><br><br><br><br><br><br>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    .header.shrink .reserveren:hover {
    font-size: 1rem;
    box-shadow: 0 12px 25px rgba(191, 161, 70, 0.6);
    transform: translateY(-3px);
    }
    body {
    font-family: sans-serif;
    background: #f5f5f5;
    padding-top: 0; /* ruimte boven content zodat header niet overlapt */
    }

    .header {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 1200px;
        border-radius: 16px;
        backdrop-filter: blur(12px);
        background-color: rgba(255, 255, 255, 0.6);
        transition: all 0.4s ease;
        z-index: 1000;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        opacity: 0;
        animation: fadeInDown 0.8s ease forwards;
        animation-delay: 0.2s;
    }
    .logo {
        width: 70px;
        height: 70px;
    }
    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1rem;
        transition: all 0.4s ease;
    }

    .nav.shrink {
    padding: 0.5rem 1rem;
    }

    .nav.shrink .logo {
    width: 50px;
    height: 50px;
    }

    .nav.shrink .nav-links {
    gap: 1rem;
    font-size: 1.4rem;
    }

    .nav.shrink .nav-links a {
    font-size: 0.95rem;
    }

    .header.shrink {
    top: 10px;
    width: 40%;
    border-radius: 12px;
    background-color: rgba(255, 255, 255, 0.85);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    padding: 0;
    }


    @keyframes fadeInDown {
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
    }
    .nav-links {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-left: auto;
        transition: all 0.3s;
    }

    .nav-links .nav-item {
        display: flex;
        align-items: center;
    }

    .nav-links .nav-link {
        text-decoration: none;
        color: #000;
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
        padding: 0.5rem 0.8rem;
    }

    .nav-links .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 100%;
        height: 2px;
        background: #000;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .nav-links .nav-link:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    .reserveren {
        background: linear-gradient(145deg, #0b0b0a, #63635f);
        color: #f8f4f4;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 50px;
        box-shadow: 0 8px 20px rgba(2, 2, 2, 0.5);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        margin-left: 20px;
    }

    .reserveren::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transform: skewX(-25deg);
        transition: left 0.4s ease;
    }

    .reserveren:hover::before {
        left: 100%;
    }

    .reserveren:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(191, 161, 70, 0.6);
        font-size: 100%;
    }

    .navbar-toggler {
        border: none;
        background: none;
        font-size: 2rem;
        display: none;
    }

    .navbar-toggler-icon {
        display: inline-block;
        width: 2em;
        height: 2em;
        vertical-align: middle;
        background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280,0,0,0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") center/contain no-repeat;
    }

    @media (max-width: 991px) {
        .nav-links {
            flex-direction: column;
            align-items: flex-start;
            background: rgba(255,255,255,0.97);
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 1rem 2rem;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            display: none;
        }
        .nav-links.show {
            display: flex;
        }
        .navbar-toggler {
            display: block;
        }
        .nav {
            flex-wrap: wrap;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    let lastScrollTop = 0;
    const nav = document.querySelector('.nav');
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop + 10) {
            nav.classList.add('shrink');
            header.classList.add('shrink');
        } else if (scrollTop < lastScrollTop - 10 || scrollTop <= 0) {
            nav.classList.remove('shrink');
            header.classList.remove('shrink');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
    // Sluit menu bij klik buiten menu op mobiel
    document.addEventListener('click', function(e) {
        const navLinks = document.getElementById('navLinks');
        const toggler = document.querySelector('.navbar-toggler');
        if (window.innerWidth < 992 && navLinks.classList.contains('show')) {
            if (!navLinks.contains(e.target) && !toggler.contains(e.target)) {
                navLinks.classList.remove('show');
            }
        }
    });
});
</script>