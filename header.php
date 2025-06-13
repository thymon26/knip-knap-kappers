    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <header class="header">
        <nav class="nav">
        <img src="/Assets/logo.png" alt="Logo" class="logo"/>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="producten.php">Producten</a></li>
            <li><a href="#">Prijzen</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php">
            <button class="cart-btn" id="cartBtn" style="background: none; border: none; position: relative; margin-right: 10px;">
                <i class="bi bi-cart" style="font-size: 1.7rem;"></i>
                <span id="cartCount" style="position: absolute; top: -6px; right: -8px; background: #bfa046; color: #fff; border-radius: 50%; font-size: 0.85rem; padding: 2px 7px; min-width: 22px; text-align: center;">0</span>
            </button>
            </a>
            <button class="reserveren" onclick="location.href='reserveren.php'">Reserveren</button>
            </li>
        </ul>
        </nav>
    </header>
    <style>
            * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    .header.shrink .reserveren:hover {
    font-size: 1rem;
    box-shadow: 0 12px 25px rgba(255, 215, 0, 0.6);
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
    }

    .nav-links li:last-child {
    margin-left: auto;
    display: flex;
    align-items: center;
    }

    .reserveren {
    margin-left: 0;
    float: none;
    }
    .nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem 3rem;
    transition: all 0.4s ease;
    }

    .nav-links a {
    text-decoration: none;
    color: #000;
    font-weight: 500;
    position: relative;
    transition: color 0.3s ease;
    }

    .nav-links a::after {
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

    .nav-links a:hover::after {
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
        float: right;
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
        box-shadow: 0 12px 25px rgba(255, 215, 0, 0.6);
        font-size: 100%;
    }

    .hero {
    height: 100vh;
    background: linear-gradient(to bottom, #ffffff, #e0e0e0);
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 0;
    margin-top: 0;
    }

    .content {
    padding: 4rem;
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
        // Scroll naar beneden
        nav.classList.add('shrink');
        header.classList.add('shrink');
        } else if (scrollTop < lastScrollTop - 10 || scrollTop <= 0) {
        // Scroll naar boven
        nav.classList.remove('shrink');
        header.classList.remove('shrink');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
    });
    </script>