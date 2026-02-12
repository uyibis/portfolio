<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(env('AUTHOR_IMAGE')) }}">
    <title>Landing 2</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">

    @php
    $landing2BgPath = env('LANDING2_BG', 'background/1.jpg');
    $landing2BgUrl = $landing2BgPath ? asset($landing2BgPath) : null;
    @endphp

    <style>
        :root {
            --wf-bg: #0b1220;
            --wf-panel: rgba(0, 0, 0, 0.14);
            --wf-surface: rgba(255, 255, 255, 0.05);
            --wf-border: rgba(255, 255, 255, 0.12);
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            background: radial-gradient(1200px 600px at 20% 10%, rgba(72, 149, 239, 0.18), transparent 55%),
                radial-gradient(900px 500px at 80% 30%, rgba(247, 37, 133, 0.12), transparent 55%),
                var(--wf-bg);
        }

        .wf-preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: grid;
            place-items: center;
            background: rgba(7, 27, 52, 0.84);
            background-image: none;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            isolation: isolate;
            transition: opacity 420ms ease, visibility 420ms ease;
        }

        .wf-preloader::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(1100px 600px at 20% 10%, rgba(72, 149, 239, 0.18), transparent 55%),
                radial-gradient(900px 520px at 80% 30%, rgba(247, 37, 133, 0.14), transparent 58%),
                linear-gradient(180deg, rgba(0, 0, 0, 0.16), rgba(0, 0, 0, 0.28));
            opacity: 0.95;
            pointer-events: none;
            z-index: 0;
        }

        .wf-preloader.is-hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .wf-preloader__wave {
            width: min(280px, 72vw);
            height: 64px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 10px;
            filter: drop-shadow(0 24px 70px rgba(0, 0, 0, 0.55));
            position: relative;
            z-index: 1;
        }

        .wf-preloader__bar {
            width: 10px;
            height: 18px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: linear-gradient(180deg, rgba(92, 212, 255, 0.85), rgba(124, 92, 255, 0.70));
            transform-origin: bottom;
            animation: wf-wave 860ms ease-in-out infinite;
            opacity: 0.85;
        }

        .wf-preloader__bar:nth-child(2) {
            animation-delay: 80ms;
        }

        .wf-preloader__bar:nth-child(3) {
            animation-delay: 160ms;
        }

        .wf-preloader__bar:nth-child(4) {
            animation-delay: 240ms;
        }

        .wf-preloader__bar:nth-child(5) {
            animation-delay: 320ms;
        }

        .wf-preloader__bar:nth-child(6) {
            animation-delay: 400ms;
        }

        .wf-preloader__bar:nth-child(7) {
            animation-delay: 480ms;
        }

        @keyframes wf-wave {

            0%,
            100% {
                transform: scaleY(0.35);
                opacity: 0.55;
            }

            50% {
                transform: scaleY(1.9);
                opacity: 0.98;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .wf-preloader__bar {
                animation: none;
            }
        }

        .wf-frame {
            min-height: 100vh;
            height: 100vh;
            padding: 0;
            display: flex;
            align-items: stretch;
            position: relative;
            --wf-boundary: 25%;
        }

        .wf-frame.is-collapsed {
            --wf-boundary: 0%;
        }

        .wf-toggle {
            position: absolute;
            top: 50%;
            left: var(--wf-boundary);
            z-index: 10;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px dashed var(--wf-border);
            background: rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(10px);
            cursor: pointer;
            transform: translate(-50%, -50%);
        }

        .wf-frame.is-collapsed .wf-toggle {
            left: 0;
            transform: translate(0, -50%);
            border-left: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .wf-toggle:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.25);
            outline-offset: 3px;
        }

        .wf-toggle::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            border-right: 2px solid rgba(255, 255, 255, 0.7);
            border-bottom: 2px solid rgba(255, 255, 255, 0.7);
            transform: translate(-50%, -50%) rotate(135deg);
        }

        .wf-frame.is-collapsed .wf-toggle::before {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .wf-two-col {
            width: 100%;
            height: 100%;
            margin: 0;
            display: grid;
            grid-template-columns: 3fr 9fr;
            gap: 0;
            padding: 0;
            border: 0;
            border-radius: 0;
            background: var(--wf-panel);
            backdrop-filter: blur(10px);
            transition: grid-template-columns 220ms ease;
        }

        .wf-two-col.is-collapsed {
            grid-template-columns: 0 1fr;
        }

        .lp-left {
            height: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: space-between;
            padding: 26px 20px;
            background: #071b34;
            position: relative;
            overflow: hidden;
        }

        .lp-left::before {
            content: none;
        }

        .lp-left__top,
        .lp-left__bottom {
            position: relative;
            z-index: 1;
        }

        .lp-left__top {
            display: flex;
            flex-direction: column;
        }

        .lp-avatar {
            width: 86px;
            height: 86px;
            margin: 0 auto;
            align-self: center;
            border-radius: 999px;
            border: 6px solid rgba(255, 255, 255, 0.90);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.18);
        }

        .lp-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .lp-name {
            margin: 18px 0 8px;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.3px;
            line-height: 1.05;
            color: rgba(255, 255, 255, 0.96);
        }

        .lp-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #ff4d4d;
            margin-left: 8px;
            transform: translateY(-2px);
        }

        .lp-role {
            margin: 0;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.70);
        }

        .lp-bio {
            margin: 14px 0 0;
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.86);
            max-width: 46ch;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
        }

        .lp-cta {
            margin-top: 22px;
            display: flex;
            gap: 10px;
        }

        .lp-btn {
            height: 44px;
            flex: 1;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(10px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.92);
            text-decoration: none;
        }

        .lp-btn:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        .lp-btn:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.28);
            outline-offset: 3px;
        }

        .lp-btn i {
            font-size: 14px;
        }

        .lp-social {
            display: flex;
            gap: 10px;
        }

        .lp-social a {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.10);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.92);
            text-decoration: none;
        }

        .lp-social a:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.28);
            outline-offset: 3px;
        }

        @media (max-width: 900px) {
            .wf-frame {
                padding: 0;
                height: auto;
            }

            .wf-toggle {
                display: none;
            }

            .wf-two-col {
                grid-template-columns: 1fr;
                gap: 0;
                padding: 0;
                height: auto;
            }
        }

        .wf-col {
            border: 1px dashed var(--wf-border);
            border-radius: 0;
            background: var(--wf-surface);
            height: 100%;
            min-height: 0;
            overflow: hidden;
            transition: opacity 160ms ease;
        }

        .wf-col--left {
            border-left: 0;
            border-top: 0;
            border-bottom: 0;
            background: #071b34;
        }

        .wf-col--right {
            border-right: 0;
            border-top: 0;
            border-bottom: 0;
        }

        .wf-two-col.is-collapsed .wf-col--left {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            border: 0;
        }

        @media (max-width: 900px) {
            .wf-col {
                height: auto;
                min-height: 46vh;
            }
        }

        .wf-col::before {
            content: "";
            display: block;
            height: 100%;
            border-radius: 0;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.04), transparent 55%),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.03) 0 12px, transparent 12px 26px);
            opacity: 0.55;
        }

        .wf-col--right::before {
            content: none;
        }

        .wf-col--left::before {
            content: none;
        }

        .wf-slider {
            height: 100%;
            position: relative;
        }

        .wf-slider__viewport {
            position: relative;
            overflow: hidden;
            height: 100%;
            min-height: 0;
        }

        .wf-slider__track {
            display: flex;
            width: 100%;
            height: 100%;
            transform: translateX(calc(var(--wf-slide, 0) * -100%));
            transition: transform 260ms ease;
        }

        .wf-slide {
            flex: 0 0 100%;
            height: 100%;
            position: relative;
            min-height: 0;
            overflow-x: hidden;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
        }

        .wf-slide__bg {
            position: absolute;
            inset: 0;
            background: center / cover no-repeat;
            transform: scale(1.02);
            filter: saturate(1.05) contrast(1.05);
            z-index: 0;
        }

        .wf-slide__bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(1200px 700px at 10% 10%, rgba(72, 149, 239, 0.18), transparent 55%),
                radial-gradient(1000px 650px at 90% 25%, rgba(247, 37, 133, 0.14), transparent 55%),
                linear-gradient(180deg, rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.62));
        }

        .wf-slide__content {
            position: relative;
            z-index: 2;
            min-height: 100%;
            height: auto;
            padding: 84px 22px 92px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 18px;
        }

        .wf-slide__content--about {
            align-items: center;
        }

        .wf-about-media {
            height: 52vh;
            min-height: 360px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .wf-about-media::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(1200px 420px at 0% 0%, rgba(124, 92, 255, 0.25), transparent 55%),
                linear-gradient(180deg, rgba(0, 0, 0, 0.18), rgba(0, 0, 0, 0.40)),
                repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0 14px, transparent 14px 30px);
            opacity: 0.85;
        }

        .wf-about-card {
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
            border-radius: 14px;
            padding: 18px;
            display: grid;
            gap: 12px;
            backdrop-filter: blur(10px);
        }

        .wf-about-name {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.2px;
            color: rgba(255, 255, 255, 0.92);
        }

        .wf-about-role {
            margin: -6px 0 0;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
        }

        .wf-about-bio {
            margin: 0;
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.86);
        }

        .wf-slide--about .wf-slide__content {
            grid-template-columns: 1fr;
            align-content: center;
            justify-items: center;
        }

        .wf-slide--about .wf-about-card--present {
            width: min(980px, 100%);
        }

        .wf-about-title {
            margin: 0;
            font-size: 34px;
            line-height: 1.08;
            font-weight: 900;
            letter-spacing: -0.6px;
            color: rgba(255, 255, 255, 0.96);
        }

        .wf-about-subtitle {
            margin: -2px 0 0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
        }

        .wf-about-card.wf-about-card--present {
            padding: 22px;
            gap: 14px;
        }

        .wf-about-lead {
            margin: 0;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.86);
        }

        .wf-about-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 2px;
        }

        .wf-about-actions .wf-action {
            border-radius: 999px;
            padding: 10px 14px;
        }

        @media (max-width: 900px) {
            .wf-about-title {
                font-size: 26px;
            }

            .wf-about-media {
                min-height: 260px;
                height: 38vh;
            }
        }

        .wf-section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.78);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            width: fit-content;
        }

        .wf-slide__content--single {
            grid-template-columns: 1fr;
            align-content: start;
        }

        .wf-slide__content--services {
            padding-top: 84px;
            padding-bottom: 92px;
            padding-left: 18px;
            padding-right: 18px;
        }

        .wf-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 2px;
        }

        .wf-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
            color: rgba(255, 255, 255, 0.90);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .wf-action:hover {
            background: rgba(0, 0, 0, 0.26);
        }

        .wf-skill {
            display: grid;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
        }

        .wf-skill__head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.82);
            font-weight: 700;
        }

        .wf-progress {
            height: 10px;
            border-radius: 999px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.20);
            overflow: hidden;
        }

        .wf-progress__bar {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(124, 92, 255, 0.65), rgba(92, 212, 255, 0.55));
            border-radius: 999px;
        }

        .wf-facts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .wf-fact {
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
            border-radius: 14px;
            padding: 14px;
            display: grid;
            gap: 6px;
        }

        .wf-fact__num {
            font-size: 22px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.92);
            letter-spacing: 0.2px;
        }

        .wf-fact__label {
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.72);
        }

        .wf-services {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .wf-service {
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            border-radius: 14px;
            padding: 14px;
            display: grid;
            gap: 8px;
        }

        .wf-service__title {
            font-size: 13px;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.90);
            margin: 0;
        }

        .wf-service__desc {
            margin: 0;
            font-size: 13px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.78);
        }


        .wf-services-tabs {
            margin-top: 0;
            position: relative;
            border-radius: 16px;
            border: 1px dashed rgba(255, 255, 255, 0.18);
            background: rgba(0, 0, 0, 0.14);
            overflow: hidden;
            display: grid;
            grid-template-columns: 240px 1fr;
            min-height: min(680px, 74vh);
        }

        .wf-services-tabs__toc {
            padding: 14px;
            border-right: 1px dashed rgba(255, 255, 255, 0.14);
            background: rgba(0, 0, 0, 0.10);
            display: grid;
            align-content: start;
            gap: 10px;
        }

        .wf-services-tabs__toc-title {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
            margin: 2px 0 6px;
        }

        .wf-services-tabs__toc-item {
            width: 100%;
            text-align: left;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.82);
            font-size: 12px;
            font-weight: 850;
            letter-spacing: 0.3px;
            cursor: pointer;
        }

        .wf-services-tabs__toc-item[aria-current="true"] {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.30);
            color: rgba(255, 255, 255, 0.94);
        }

        .wf-services-tabs__toc-item:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.25);
            outline-offset: 3px;
        }

        .wf-services-tabs__panel {
            height: min(640px, 68vh);
            min-height: 420px;
            overflow-y: auto;
            overflow-x: hidden;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .wf-services-tabs__panel::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .wf-services-tabs__item {
            width: 100%;
            min-height: 100%;
            scroll-snap-align: start;
            padding: 16px;
            box-sizing: border-box;
            display: flex;
            align-items: stretch;
        }

        .wf-service-card {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: 76px 1fr;
            gap: 14px;
            padding: 18px;
            border-radius: 16px;
            border: 1px dashed rgba(255, 255, 255, 0.20);
            background:
                radial-gradient(900px 520px at 20% 10%, rgba(72, 149, 239, 0.10), transparent 55%),
                radial-gradient(820px 520px at 80% 20%, rgba(247, 37, 133, 0.08), transparent 58%),
                rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
        }

        .wf-service-card__icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
            display: grid;
            place-items: center;
            color: rgba(255, 255, 255, 0.92);
            font-size: 22px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.30);
        }

        .wf-service-card__title {
            margin: 0;
            font-size: 22px;
            font-weight: 950;
            letter-spacing: 0.2px;
            color: rgba(255, 255, 255, 0.94);
        }

        .wf-service-card__desc {
            margin: 8px 0 0;
            font-size: 13px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.80);
            max-width: 64ch;
        }

        .wf-service-card__list {
            margin: 12px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .wf-service-card__list li {
            display: grid;
            grid-template-columns: 18px 1fr;
            gap: 10px;
            align-items: start;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.18);
            background: rgba(0, 0, 0, 0.16);
            color: rgba(255, 255, 255, 0.82);
            font-size: 12px;
            line-height: 1.55;
        }

        .wf-service-card__list li::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 999px;
            margin-top: 4px;
            background: linear-gradient(180deg, rgba(92, 212, 255, 0.85), rgba(124, 92, 255, 0.65));
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.06);
        }

        @media (max-width: 900px) {
            .wf-services-tabs {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .wf-services-tabs__toc {
                grid-auto-flow: column;
                grid-auto-columns: max-content;
                overflow-x: auto;
                border-right: 0;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.14);
                gap: 8px;
                padding: 12px;
                scrollbar-width: thin;
            }

            .wf-services-tabs__toc-title {
                display: none;
            }

            .wf-services-tabs__toc-item {
                white-space: nowrap;
            }

            .wf-service-card {
                grid-template-columns: 1fr;
            }

            .wf-service-card__icon {
                width: 56px;
                height: 56px;
                border-radius: 16px;
            }

            .wf-services-tabs__panel {
                height: auto;
                min-height: 0;
                overflow: visible;
                scroll-snap-type: none;
            }

            .wf-services-tabs__item {
                min-height: auto;
            }

        }

        .wf-timeline {
            display: grid;
            gap: 12px;
        }

        .wf-timeline-item {
            display: grid;
            grid-template-columns: 92px 1fr;
            gap: 14px;
            padding: 14px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
        }

        .wf-timeline-year {
            font-size: 12px;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.78);
        }

        .wf-timeline-title {
            margin: 0;
            font-size: 14px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.92);
        }

        .wf-timeline-meta {
            margin: 4px 0 0;
            font-size: 12px;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.76);
        }

        .wf-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .wf-meta-item {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
        }

        .wf-contact {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 14px;
        }

        @media (max-width: 900px) {

            .wf-facts,
            .wf-services,
            .wf-meta,
            .wf-contact {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .wf-slide__content {
                grid-template-columns: 1fr;
                padding: 16px;
            }
        }

        .wf-block {
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            border-radius: 14px;
        }

        .wf-block--hero {
            height: 52vh;
            min-height: 360px;
            position: relative;
            overflow: hidden;
        }

        .wf-project-media {
            height: 52vh;
            min-height: 360px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .wf-project-media::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.38)),
                repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0 14px, transparent 14px 30px);
            opacity: 0.7;
        }

        .wf-projects-shell {
            width: min(980px, 100%);
            margin-inline: auto;
            display: grid;
            gap: 14px;
        }

        .wf-projects-vslider {
            --wf-projects-viewport-h: 52vh;
            --wf-projects-viewport-min-h: 360px;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: auto 1fr;
            gap: 12px;
            align-items: stretch;
        }

        .wf-projects-vslider__head {
            display: flex;
            justify-content: flex-end;
        }

        .wf-projects-vslider__viewport {
            height: var(--wf-projects-viewport-h);
            min-height: var(--wf-projects-viewport-min-h);
            overflow: auto;
            scroll-snap-type: y mandatory;
            overscroll-behavior: contain;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.04);
            padding: 0;
            -ms-overflow-style: none;
            /* IE/Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .wf-projects-vslider__viewport::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .wf-projects-vslider__viewport::-webkit-scrollbar-thumb {
            background: transparent;
        }

        .wf-projects-vslider__viewport:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.85);
            outline-offset: 3px;
        }

        .wf-projects-vslider__track {
            display: flex;
            flex-direction: column;
        }

        .wf-projects-vslider__item {
            scroll-snap-align: start;
            scroll-snap-stop: always;
            height: var(--wf-projects-viewport-h);
            min-height: var(--wf-projects-viewport-min-h);
            padding: 10px;
            box-sizing: border-box;
            display: flex;
        }

        .wf-projects-vslider__controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .wf-projects-vslider__btn {
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(0, 0, 0, 0.18);
            color: rgba(255, 255, 255, 0.92);
            border-radius: 12px;
            padding: 10px 12px;
            cursor: pointer;
        }

        .wf-projects-vslider__btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .wf-projects-vslider__count {
            text-align: center;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
        }

        .wf-project-card {
            display: grid;
            grid-template-columns: 1.65fr 1fr;
            gap: 14px;
            border-radius: 14px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.18);
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .wf-project-card__media {
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.06);
        }

        .wf-project-card__media::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, 0.08), rgba(0, 0, 0, 0.42));
            pointer-events: none;
        }

        .wf-project-carousel__viewport {
            width: 100%;
            height: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            scroll-snap-type: x mandatory;
            overscroll-behavior: contain;
            position: relative;
            z-index: 1;
            -ms-overflow-style: none;
            /* IE/Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .wf-project-carousel__viewport::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .wf-project-carousel__viewport::-webkit-scrollbar-thumb {
            background: transparent;
        }

        .wf-project-carousel__viewport:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.85);
            outline-offset: -2px;
        }

        .wf-project-carousel__track {
            height: 100%;
            display: flex;
        }

        .wf-project-carousel__item {
            flex: 0 0 100%;
            height: 100%;
            scroll-snap-align: start;
            scroll-snap-stop: always;
            display: grid;
            place-items: stretch;
            position: relative;
        }

        .wf-project-carousel__item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: saturate(1.05) contrast(1.05);
        }

        .wf-project-carousel__item--empty {
            display: grid;
            place-items: center;
            color: rgba(255, 255, 255, 0.75);
            font-size: 12px;
        }

        .wf-project-carousel__controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        .wf-project-carousel__btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(0, 0, 0, 0.22);
            color: rgba(255, 255, 255, 0.92);
            cursor: pointer;
            display: grid;
            place-items: center;
            backdrop-filter: blur(8px);
        }

        .wf-project-carousel__btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .wf-project-card__body {
            padding: 14px 14px 14px 0;
            display: grid;
            gap: 8px;
        }

        .wf-project-card__title {
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.2px;
            color: rgba(255, 255, 255, 0.95);
        }

        .wf-project-card__desc {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.45;
        }

        .wf-project-card__tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: flex-start;
            align-content: flex-start;
        }

        .wf-project-card__tag {
            font-size: 10.5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1.1;
            padding: 2px 8px;
            border-radius: 999px;
            border: 0;
            outline: 0;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.82);
            align-self: flex-start;
            white-space: nowrap;
        }

        .wf-project-card__actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        @media (max-width: 600px) {
            .wf-project-card {
                grid-template-columns: 1fr;
            }

            .wf-project-card__body {
                padding: 12px;
            }

            .wf-project-carousel__controls {
                top: 8px;
                right: 8px;
            }
        }

        .wf-block--hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.06), transparent 60%),
                repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0 14px, transparent 14px 30px);
            opacity: 0.65;
        }

        .wf-stack {
            display: grid;
            gap: 12px;
        }

        .wf-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .wf-line {
            height: 12px;
            border-radius: 999px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
        }

        .wf-line.sm {
            height: 10px;
            opacity: 0.9;
        }

        .wf-pill {
            height: 26px;
            width: 86px;
            border-radius: 999px;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
        }

        .wf-card {
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(0, 0, 0, 0.14);
            border-radius: 14px;
            padding: 14px;
        }

        .wf-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        @media (max-width: 900px) {
            .wf-grid {
                grid-template-columns: 1fr;
            }
        }

        .wf-slide::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.05), transparent 55%),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.03) 0 12px, transparent 12px 26px);
            opacity: 0.18;
        }

        .wf-slider__btn {
            position: relative;
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px dashed var(--wf-border);
            background: rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .wf-slider__btn:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.25);
            outline-offset: 3px;
        }

        .wf-slider__controls {
            position: absolute;
            right: 14px;
            bottom: 14px;
            z-index: 6;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1px dashed var(--wf-border);
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(10px);
        }

        .wf-slider__nav {
            position: absolute;
            right: 14px;
            top: 14px;
            z-index: 6;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1px dashed var(--wf-border);
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(10px);
        }

        .wf-slider__menu {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
            max-width: min(920px, calc(100vw - 42px));
        }

        .wf-nav-item {
            appearance: none;
            border: 1px dashed rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.80);
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .wf-nav-item[aria-current="true"] {
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.30);
            color: rgba(255, 255, 255, 0.94);
        }

        .wf-nav-item:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.25);
            outline-offset: 3px;
        }

        .wf-slider__btn::before {
            content: "";

            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            border-right: 2px solid rgba(255, 255, 255, 0.7);
            border-bottom: 2px solid rgba(255, 255, 255, 0.7);
            transform: translate(-50%, -50%) rotate(135deg);
        }

        .wf-slider__btn--next::before {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .wf-slider__btn--next.is-blink {
            animation: wf-next-blink 1100ms ease-in-out infinite;
        }

        @keyframes wf-next-blink {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(92, 212, 255, 0.0), 0 18px 55px rgba(0, 0, 0, 0.22);
                border-color: rgba(255, 255, 255, 0.14);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(92, 212, 255, 0.14), 0 18px 65px rgba(0, 0, 0, 0.30);
                border-color: rgba(92, 212, 255, 0.35);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .wf-slider__btn--next.is-blink {
                animation: none;
            }
        }

        .wf-slider__dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 0;
            border: 0;
            background: transparent;
            backdrop-filter: none;
        }

        .wf-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.08);
            cursor: pointer;
            padding: 0;
        }

        .wf-dot[aria-current="true"] {
            background: rgba(255, 255, 255, 0.55);
            border-color: rgba(255, 255, 255, 0.65);
        }
    </style>
</head>

<body>
    <div class="wf-preloader" id="wf-preloader" role="status" aria-label="Loading">
        <div class="wf-preloader__wave" aria-hidden="true">
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
            <span class="wf-preloader__bar"></span>
        </div>
    </div>

    <div class="wf-frame">
        <button class="wf-toggle" type="button" aria-label="Toggle left column" aria-controls="wf-two-col"
            aria-expanded="true"></button>

        <div id="wf-two-col" class="wf-two-col" aria-label="Two column wireframe">
            <div class="wf-col wf-col--left" aria-label="Left column">
                <div class="lp-left" aria-label="Landing hero panel">
                    <div class="lp-left__top">
                        <div class="lp-avatar" aria-hidden="true">
                            <img src="{{ asset(env('AUTHOR_IMAGE')) }}" alt="" />
                        </div>

                        <div class="lp-name">
                            {{ env('AUTHOR') ?? '' }}<span class="lp-dot" aria-hidden="true"></span>
                        </div>
                        <div class="lp-role">Web App Developer</div>

                        @if (env('AUTHOR_BIO'))
                        <p class="lp-bio">{{ env('AUTHOR_BIO') }}</p>
                        @endif

                        <div class="lp-cta" aria-label="CTA buttons">
                            <a class="lp-btn"
                                href="{{ env('AUTHOR_RESUME_URL') ? asset(env('AUTHOR_RESUME_URL')) : '#' }}"
                                target="_blank" rel="noopener" aria-label="View resume">
                                <i class="fas fa-file-alt" aria-hidden="true"></i>
                            </a>

                            <a class="lp-btn" href="{{ env('AUTHOR_EMAIL') ? ('mailto:' . env('AUTHOR_EMAIL')) : '#' }}"
                                aria-label="Hire me">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="lp-left__bottom">
                        <div class="lp-social" aria-label="Social links">
                            <a href="{{ env('AUTHOR_LINKEDIN') ?: '#' }}" aria-label="LinkedIn"><i
                                    class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="{{ env('AUTHOR_GITHUB') ?: '#' }}" aria-label="GitHub"><i class="fab fa-github"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wf-col wf-col--right" aria-label="Right column">
                <div class="wf-slider" aria-label="Landing page section slider">
                    <div class="wf-slider__viewport" aria-live="polite">
                        <div class="wf-slider__track" style="--wf-slide: 0">
                            @php
                            $projects = $projects ?? collect();
                            $projectSlideCount = 1;

                            $authorBio = env('AUTHOR_BIO');

                            $bgPool = [
                            'background/1.jpg',
                            'background/7.jpg',
                            'background/3(2).jpg',
                            'background/1(2).jpg',
                            'background/1(3).jpg',
                            'background/1(5).jpg',
                            'background/1.png',
                            ];
                            $bgPool = array_values(array_filter($bgPool));
                            $bgForIndex = function ($i) use ($bgPool) {
                            $count = count($bgPool);
                            if ($count === 0) {
                            return null;
                            }
                            $idx = ((int) $i) % $count;
                            if ($idx < 0) { $idx +=$count; } return asset($bgPool[$idx]); }; /* Slide order: Services ->
                                Projects -> Education -> About -> Contact */
                                $indexServices = 0;
                                $indexProjects = 1;
                                $indexResume = 2;
                                $indexAbout = 3;
                                $indexContact = 4;

                                $servicesRich=[ [ 'title'=> 'Development',
                                'icon' => 'fas fa-code',
                                'desc' => 'Dotnet development you can rely on — I build clean, secure APIs, real-time
                                features, and scalable systems for your product.',
                                'points' => [
                                'Dotnet & C# (ASP.NET Core): microservices and modular web apps using clean architecture
                                and SOLID to keep codebases maintainable at scale.',
                                'Backend engineering (Laravel/PHP too): REST/GraphQL APIs, background workers, and
                                robust data layers (EF Core/Eloquent) with performance-focused query design.',
                                'Real-time and event-driven features: WebSockets/SignalR-style updates,
                                broadcasting/notifications, queues, and caching (Redis) for fast, responsive UX.',
                                'Integrations and security: JWT/OAuth, webhooks, payment gateways, Shopify APIs, email
                                services, and safe authentication/authorization flows.',
                                'Delivery and operations: Docker-first environments, Kubernetes-ready deployments, and
                                CI/CD pipelines with GitHub Actions or Azure DevOps for repeatable releases.',
                                ],
                                ],
                                [
                                'title' => 'Data Analysis',
                                'icon' => 'fas fa-chart-pie',
                                'desc' => 'Turn your raw data into decisions — clean datasets, clear metrics, and
                                dashboards your team can trust.',
                                'points' => [
                                'Data cleaning & validation: deduping, missing-value handling, sanity checks, and
                                definitions so numbers match across teams.',
                                'KPI design & reporting: North Star + supporting metrics, weekly/monthly performance
                                reporting, and stakeholder-ready summaries.',
                                'Behavior analysis: funnels, cohorts/retention, segmentation, and trend decomposition to
                                explain “what changed and why”.',
                                'Dashboarding: build clear, drill-down views for product/ops (e.g., acquisition →
                                activation → revenue), with consistent filters and time windows.',
                                'SQL-first workflow: performant queries for analytics tables/views, plus lightweight
                                ETL/exports when needed.',
                                ],
                                ],
                                [
                                'title' => 'SEO & Performance',
                                'icon' => 'fas fa-chart-line',
                                'desc' => 'Improve your search visibility and site speed with a technical SEO +
                                performance pass that moves Core Web Vitals and conversions.',
                                'points' => [
                                'Technical SEO foundation: clean URL structure, canonical strategy, robots + sitemap
                                setup, and crawl-friendly navigation.',
                                'On-page SEO readiness: titles/meta, headings, internal linking, and templates that keep
                                content consistent across pages.',
                                'Core Web Vitals & performance: reduce LCP/CLS/INP via image optimization,
                                code-splitting, caching, and removing render-blocking assets.',
                                'Structured data: schema markup where it matters (Organization, Article, Product, FAQ)
                                to improve SERP appearance and clarity.',
                                'Audit & monitoring: lighthouse/budget checks, error tracking for 404/redirect chains,
                                and a prioritized fix list with measurable wins.',
                                ],
                                ],
                                [
                                'title' => 'Support',
                                'icon' => 'fas fa-tools',
                                'desc' => 'Technical support that keeps your app stable — fast bug triage, safe
                                releases, and reliability improvements you can measure.',
                                'points' => [
                                'Incident & bug triage: reproduce issues, trace logs, isolate root causes, and ship
                                fixes with clear impact notes.',
                                'Monitoring & reliability: health checks, error tracking, performance baselines, and
                                alerting so problems are caught early.',
                                'Deployments & environments: config hygiene, secrets handling, rollout/rollback support,
                                and “works in prod” checklists.',
                                'Performance support: slow-query diagnosis, caching strategy (Redis), queue tuning, and
                                API response-time improvements.',
                                'Maintenance & hardening: dependency updates, security patches, refactors, and
                                documentation for smooth handoffs.',
                                ],
                                ],
                                ];

                                $timeline = [
                                ['Oct 2022 – Nov 2023', 'Software Engineering Program', 'ALX Holberton — Full‑Stack Web
                                Development'],
                                ['Oct 2010 – Jan 2016', 'Bachelor of Engineering (B.Eng.)', 'University of Benin, Benin
                                City'],
                                ];

                                $certifications = [
                                'Microsoft Certified: Azure Developer Associate',
                                'AWS Certified Developer – Associate',
                                'Scrum Master (PSM I)',
                                'Data Science',
                                'Laravel Certification — Advanced PHP Development',
                                'Shopify Partner Certification',
                                ];
                                @endphp <div class="wf-slide" aria-label="Services slide" data-services="true">
                                    @php $slideBg = $bgForIndex($indexServices); @endphp
                                    <div class="wf-slide__bg" aria-hidden="true" @if($slideBg)
                                        style="background-image: url('{{ $slideBg }}')" @endif></div>
                                    <div
                                        class="wf-slide__content wf-slide__content--single wf-slide__content--services">
                                        <div class="wf-services-tabs" data-services-tabs aria-label="Services">
                                            <nav class="wf-services-tabs__toc" aria-label="Services table of contents">
                                                <div class="wf-services-tabs__toc-title">Services</div>
                                                @foreach ($servicesRich as $svc)
                                                <button class="wf-services-tabs__toc-item" type="button"
                                                    data-service-index="{{ $loop->index }}"
                                                    aria-label="Show {{ $svc['title'] }}"
                                                    aria-current="{{ $loop->first ? 'true' : 'false' }}">{{
                                                    $svc['title'] }}</button>
                                                @endforeach
                                            </nav>

                                            <div class="wf-services-tabs__panel" aria-live="polite">
                                                @foreach ($servicesRich as $svc)
                                                <section class="wf-services-tabs__item"
                                                    data-service-panel="{{ $loop->index }}"
                                                    aria-label="{{ $svc['title'] }} service">
                                                    <div class="wf-service-card">
                                                        <div class="wf-service-card__icon" aria-hidden="true">
                                                            <i class="{{ $svc['icon'] }}"></i>
                                                        </div>
                                                        <div>
                                                            <h3 class="wf-service-card__title">{{ $svc['title'] }}</h3>
                                                            <p class="wf-service-card__desc">{{ $svc['desc'] }}</p>
                                                            <ul class="wf-service-card__list"
                                                                aria-label="{{ $svc['title'] }} highlights">
                                                                @foreach ($svc['points'] as $p)
                                                                <li>{{ $p }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </section>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wf-slide" aria-label="Projects slide">
                                    @php $slideBg = $bgForIndex($indexProjects); @endphp
                                    <div class="wf-slide__bg" aria-hidden="true" @if($slideBg)
                                        style="background-image: url('{{ $slideBg }}')" @endif></div>
                                    <div class="wf-slide__content wf-slide__content--single">
                                        <div class="wf-about-card wf-projects-shell" aria-label="Projects">
                                            <div>
                                                <div class="wf-section-kicker">Projects</div>
                                            </div>

                                            <div class="wf-projects-vslider" data-projects-vslider
                                                aria-label="Projects carousel">
                                                <div class="wf-projects-vslider__head"
                                                    aria-label="Project carousel header">
                                                    <div class="wf-projects-vslider__controls"
                                                        aria-label="Project carousel controls">
                                                        <button class="wf-projects-vslider__btn" type="button"
                                                            data-projects-prev aria-label="Previous project">↑</button>
                                                        <button class="wf-projects-vslider__btn" type="button"
                                                            data-projects-next aria-label="Next project">↓</button>
                                                    </div>
                                                </div>
                                                <div class="wf-projects-vslider__viewport" tabindex="0"
                                                    aria-label="Project list">
                                                    <div class="wf-projects-vslider__track">
                                                        @forelse ($projects as $project)
                                                        @php
                                                        $media = $project->featured_image;
                                                        if (!$media && is_array($project->images ?? null) &&
                                                        count($project->images)) {
                                                        $media = $project->images[0];
                                                        }

                                                        $rawImages = is_array($project->images ?? null)
                                                        ? array_values(array_filter($project->images))
                                                        : [];

                                                        if (!count($rawImages) && is_string($media) && trim($media) !==
                                                        '') {
                                                        $rawImages = [$media];
                                                        }

                                                        $imageUrls = [];
                                                        foreach ($rawImages as $img) {
                                                        if (!is_string($img) || trim($img) === '') continue;
                                                        $imageUrls[] = preg_match('/^https?:\/\//i', $img) ? $img :
                                                        asset($img);
                                                        }

                                                        $stackChips = is_array($project->stacks ?? null) ?
                                                        array_slice(array_values(array_filter($project->stacks)), 0, 6)
                                                        :
                                                        [];
                                                        $excerpt = \Illuminate\Support\Str::limit(trim((string)
                                                        $project->description), 320);
                                                        @endphp

                                                        <article class="wf-projects-vslider__item"
                                                            aria-label="Project: {{ $project->title }}">
                                                            <div class="wf-project-card">
                                                                <div class="wf-project-card__media"
                                                                    data-project-carousel
                                                                    aria-label="{{ $project->title }} images">
                                                                    <div class="wf-project-carousel__controls"
                                                                        aria-label="Image controls">
                                                                        <button class="wf-project-carousel__btn"
                                                                            type="button" data-carousel-prev
                                                                            aria-label="Previous image">←</button>
                                                                        <button class="wf-project-carousel__btn"
                                                                            type="button" data-carousel-next
                                                                            aria-label="Next image">→</button>
                                                                    </div>

                                                                    <div class="wf-project-carousel__viewport"
                                                                        tabindex="0" aria-label="Image carousel">
                                                                        <div class="wf-project-carousel__track">
                                                                            @forelse ($imageUrls as $url)
                                                                            <div class="wf-project-carousel__item"
                                                                                aria-label="Image {{ $loop->iteration }}">
                                                                                <img src="{{ $url }}" loading="lazy"
                                                                                    alt="{{ $project->title }} image {{ $loop->iteration }}" />
                                                                            </div>
                                                                            @empty
                                                                            <div class="wf-project-carousel__item wf-project-carousel__item--empty"
                                                                                aria-label="No images">
                                                                                No images
                                                                            </div>
                                                                            @endforelse
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="wf-project-card__body">
                                                                    <div class="wf-project-card__title">{{
                                                                        $project->title }}</div>
                                                                    @if(count($stackChips))
                                                                    <div class="wf-project-card__tags"
                                                                        aria-label="Stacks">
                                                                        @foreach($stackChips as $chip)
                                                                        <span class="wf-project-card__tag">{{ $chip
                                                                            }}</span>
                                                                        @endforeach
                                                                    </div>
                                                                    @endif
                                                                    <div class="wf-project-card__desc">{{ $excerpt }}
                                                                    </div>
                                                                    <div class="wf-project-card__actions">
                                                                        @php
                                                                        $projectHref = null;
                                                                        if (is_string($project->link ?? null) &&
                                                                        trim($project->link) !== '') {
                                                                        $projectHref = $project->link;
                                                                        }
                                                                        @endphp

                                                                        <a class="wf-action"
                                                                            href="{{ $projectHref ? e($projectHref) : route('projects.show', $project->slug) }}"
                                                                            @if($projectHref) target="_blank"
                                                                            rel="noopener noreferrer" @endif>Open</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                        @empty
                                                        <div class="wf-projects-vslider__item" aria-label="No projects">
                                                            <div class="wf-project-card">
                                                                <div class="wf-project-card__media" aria-hidden="true">
                                                                </div>
                                                                <div class="wf-project-card__body">
                                                                    <div class="wf-project-card__title">No projects yet
                                                                    </div>
                                                                    <div class="wf-project-card__desc">Create a project
                                                                        from the dashboard to show it here.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wf-slide" aria-label="Education slide">
                                    @php $slideBg = $bgForIndex($indexResume); @endphp
                                    <div class="wf-slide__bg" aria-hidden="true" @if($slideBg)
                                        style="background-image: url('{{ $slideBg }}')" @endif></div>
                                    <div class="wf-slide__content wf-slide__content--single">
                                        <div class="wf-about-card" aria-label="Education content">
                                            <div class="wf-section-kicker">Education</div>
                                            <h2 class="wf-about-name">Education</h2>
                                            <p class="wf-about-bio">Academic background and professional certifications.
                                            </p>
                                            <div class="wf-timeline" aria-label="Timeline">
                                                @foreach ($timeline as $t)
                                                <div class="wf-timeline-item">
                                                    <div class="wf-timeline-year">{{ $t[0] }}</div>
                                                    <div>
                                                        <h3 class="wf-timeline-title">{{ $t[1] }}</h3>
                                                        @if (!empty($t[2]))
                                                        <div class="wf-timeline-meta">{{ $t[2] }}</div>
                                                        @endif
                                                        <div class="wf-stack" aria-hidden="true"
                                                            style="margin-top: 8px">
                                                            <div class="wf-line sm" style="width: 78%"></div>
                                                            <div class="wf-line sm" style="width: 62%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="wf-stack" style="margin-top: 14px" aria-label="Certifications">
                                                <div class="wf-section-kicker">Certifications</div>
                                                <ul class="wf-service-card__list" aria-label="Certification list">
                                                    @foreach ($certifications as $c)
                                                    <li>{{ $c }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wf-slide wf-slide--about" aria-label="About slide">
                                    @php $slideBg = $bgForIndex($indexAbout); @endphp
                                    <div class="wf-slide__bg" aria-hidden="true" @if($slideBg)
                                        style="background-image: url('{{ $slideBg }}')" @endif></div>
                                    <div class="wf-slide__content wf-slide__content--single">
                                        <div class="wf-about-card wf-about-card--present" aria-label="About content">
                                            <div class="wf-section-kicker">About</div>
                                            <h2 class="wf-about-title">About Me</h2>
                                            <div class="wf-about-subtitle">Web App Developer</div>

                                            <p class="wf-about-lead">{{ $authorBio ?: 'About section content.' }}</p>

                                            <div class="wf-meta" aria-label="About details">
                                                <div class="wf-meta-item">Name: {{ env('AUTHOR') ?? '—' }}</div>
                                                <div class="wf-meta-item">Email: {{ env('AUTHOR_EMAIL') ?: '—' }}</div>
                                                <div class="wf-meta-item">Location: {{ env('AUTHOR_LOCATION') ?: '—' }}
                                                </div>
                                                <div class="wf-meta-item">Birthday: {{ env('AUTHOR_BIRTHDAY') ?: '—' }}
                                                </div>
                                            </div>

                                            <div class="wf-about-actions" aria-label="About actions">
                                                <a class="wf-action"
                                                    href="{{ env('AUTHOR_RESUME_URL') ? asset(env('AUTHOR_RESUME_URL')) : '#' }}"
                                                    target="_blank" rel="noopener">Download CV</a>
                                                <a class="wf-action"
                                                    href="{{ env('AUTHOR_EMAIL') ? ('mailto:' . env('AUTHOR_EMAIL')) : '#' }}">Hire
                                                    me</a>
                                                <a class="wf-action" href="{{ env('AUTHOR_GITHUB') ?: '#' }}"
                                                    target="_blank" rel="noopener">GitHub</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wf-slide" aria-label="Contact slide">
                                    @php $slideBg = $bgForIndex($indexContact); @endphp
                                    <div class="wf-slide__bg" aria-hidden="true" @if($slideBg)
                                        style="background-image: url('{{ $slideBg }}')" @endif></div>
                                    <div class="wf-slide__content wf-slide__content--single">
                                        <div class="wf-about-card" aria-label="Contact content">
                                            <div class="wf-section-kicker">Contact</div>
                                            <h2 class="wf-about-name">Get in touch</h2>
                                            <div class="wf-contact" aria-label="Contact layout">
                                                <div class="wf-stack">
                                                    <div class="wf-meta-item">Phone: —</div>
                                                    <div class="wf-meta-item">Email: {{ env('AUTHOR_EMAIL') ?: '—' }}
                                                    </div>
                                                    <div class="wf-meta-item">Location: —</div>
                                                </div>
                                                <div class="wf-stack" aria-label="Contact form wireframe">
                                                    <div class="wf-line" style="width: 48%"></div>
                                                    <div class="wf-line" style="width: 76%"></div>
                                                    <div class="wf-line" style="width: 92%"></div>
                                                    <div class="wf-card" style="min-height: 160px"></div>
                                                    <div class="wf-pill" style="width: 120px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="wf-slider__nav" aria-label="Slide navigation">
                            <div class="wf-slider__menu" aria-label="Section menu">
                                <button class="wf-nav-item" type="button" data-go="{{ $indexServices }}"
                                    data-start="{{ $indexServices }}" data-end="{{ $indexServices }}"
                                    aria-current="true">Services</button>
                                <button class="wf-nav-item" type="button" data-go="{{ $indexProjects }}"
                                    data-start="{{ $indexProjects }}" data-end="{{ $indexProjects }}"
                                    aria-current="false">Projects</button>
                                <button class="wf-nav-item" type="button" data-go="{{ $indexResume }}"
                                    data-start="{{ $indexResume }}" data-end="{{ $indexResume }}"
                                    aria-current="false">Education</button>
                                <button class="wf-nav-item" type="button" data-go="{{ $indexAbout }}"
                                    data-start="{{ $indexAbout }}" data-end="{{ $indexAbout }}"
                                    aria-current="false">About</button>
                                <button class="wf-nav-item" type="button" data-go="{{ $indexContact }}"
                                    data-start="{{ $indexContact }}" data-end="{{ $indexContact }}"
                                    aria-current="false">Contact</button>
                            </div>
                        </div>

                        <div class="wf-slider__controls" aria-label="Slide controls">
                            <button class="wf-slider__btn wf-slider__btn--prev" type="button"
                                aria-label="Previous slide"></button>

                            <button class="wf-slider__btn wf-slider__btn--next" type="button"
                                aria-label="Next slide"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var key = 'landing2.leftCollapsed';
            var toggle = document.querySelector('.wf-toggle');
            var grid = document.getElementById('wf-two-col');
            var frame = document.querySelector('.wf-frame');
            if (!toggle || !grid) return;

            function setCollapsed(collapsed) {
                grid.classList.toggle('is-collapsed', collapsed);
                if (frame) frame.classList.toggle('is-collapsed', collapsed);
                toggle.setAttribute('aria-expanded', String(!collapsed));
                try {
                    localStorage.setItem(key, collapsed ? '1' : '0');
                } catch (e) {
                }
            }

            var initialCollapsed = false;
            try {
                initialCollapsed = localStorage.getItem(key) === '1';
            } catch (e) {
            }
            setCollapsed(initialCollapsed);

            toggle.addEventListener('click', function () {
                setCollapsed(!grid.classList.contains('is-collapsed'));
            });
        })();
    </script>

    <script>
        (function () {
            var slider = document.querySelector('.wf-slider');
            if (!slider) return;

            var track = slider.querySelector('.wf-slider__track');
            var slides = slider.querySelectorAll('.wf-slide');
            var prevBtn = slider.querySelector('.wf-slider__btn--prev');
            var nextBtn = slider.querySelector('.wf-slider__btn--next');
            var navItems = slider.querySelectorAll('.wf-nav-item');
            if (!track || !slides.length || !prevBtn || !nextBtn) return;

            var index = 0;
            var max = slides.length - 1;

            function render() {
                track.style.setProperty('--wf-slide', String(index));
                for (var i = 0; i < navItems.length; i++) {
                    var start = Number(navItems[i].getAttribute('data-start') || '0');
                    var end = Number(navItems[i].getAttribute('data-end') || String(start));
                    var isCurrent = index >= start && index <= end;
                    navItems[i].setAttribute('aria-current', isCurrent ? 'true' : 'false');
                }

                nextBtn.classList.toggle('is-blink', index < max);
            }

            function clamp(n) {
                return Math.max(0, Math.min(max, n));
            }

            prevBtn.addEventListener('click', function () {
                index = clamp(index - 1);
                render();
            });

            nextBtn.addEventListener('click', function () {
                index = clamp(index + 1);
                render();
            });

            for (var n = 0; n < navItems.length; n++) {
                navItems[n].addEventListener('click', function (e) {
                    var go = Number(e.currentTarget.getAttribute('data-go') || '0');
                    index = clamp(go);
                    render();
                });
            }

            // Services tabs (TOC left, details right)
            var servicesTabs = slider.querySelector('[data-services-tabs]');
            var serviceTocItems = servicesTabs ? servicesTabs.querySelectorAll('[data-service-index]') : [];
            var servicePanelsViewport = servicesTabs ? servicesTabs.querySelector('.wf-services-tabs__panel') : null;
            var servicePanels = servicesTabs ? servicesTabs.querySelectorAll('[data-service-panel]') : [];

            var serviceIndex = 0;
            var serviceMax = Math.max(0, servicePanels.length - 1);

            function serviceClamp(n) {
                return Math.max(0, Math.min(serviceMax, n));
            }

            function serviceRender() {
                if (!servicesTabs || !servicePanels.length) return;

                for (var t = 0; t < serviceTocItems.length; t++) {
                    serviceTocItems[t].setAttribute('aria-current', t === serviceIndex ? 'true' : 'false');
                }
            }

            function serviceScrollToIndex(nextIndex) {
                if (!servicePanelsViewport || !servicePanels.length) return;
                var i = serviceClamp(nextIndex);
                serviceIndex = i;
                serviceRender();
                var top = servicePanels[i].offsetTop;
                servicePanelsViewport.scrollTo({ top: top, behavior: 'smooth' });
            }

            function serviceSyncFromScroll() {
                if (!servicePanelsViewport || !servicePanels.length) return;
                var probe = servicePanelsViewport.scrollTop + servicePanelsViewport.clientHeight * 0.35;
                var next = 0;
                for (var i = 0; i < servicePanels.length; i++) {
                    if (servicePanels[i].offsetTop <= probe) next = i;
                }
                if (next !== serviceIndex) {
                    serviceIndex = serviceClamp(next);
                    serviceRender();
                }
            }

            if (servicesTabs && servicePanels.length) {
                for (var st = 0; st < serviceTocItems.length; st++) {
                    serviceTocItems[st].addEventListener('click', function (e) {
                        var raw = e.currentTarget.getAttribute('data-service-index') || '0';
                        serviceScrollToIndex(Number(raw));
                    });
                }

                if (servicePanelsViewport) {
                    var ticking = false;
                    servicePanelsViewport.addEventListener('scroll', function () {
                        if (ticking) return;
                        ticking = true;
                        window.requestAnimationFrame(function () {
                            ticking = false;
                            serviceSyncFromScroll();
                        });
                    });
                }

                serviceRender();
                if (servicePanelsViewport) servicePanelsViewport.scrollTop = 0;
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowLeft') {
                    index = clamp(index - 1);
                    render();
                }
                if (e.key === 'ArrowRight') {
                    index = clamp(index + 1);
                    render();
                }

                if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                    var activeSlide = slides[index];
                    var hasServices = activeSlide && activeSlide.getAttribute && activeSlide.getAttribute('data-services') === 'true';
                    if (hasServices && servicesTabs && servicePanels.length) {
                        var ae = document.activeElement;
                        var tag = ae && ae.tagName ? ae.tagName.toLowerCase() : '';
                        var isTyping = tag === 'input' || tag === 'textarea' || tag === 'select' || (ae && ae.isContentEditable);
                        if (!isTyping) {
                            serviceScrollToIndex(serviceIndex + (e.key === 'ArrowDown' ? 1 : -1));
                            e.preventDefault();
                        }
                    }
                }
            });

            render();
        })();
    </script>

    <script>
        (function () {
            var root = document.querySelector('[data-projects-vslider]');
            if (!root) return;

            var viewport = root.querySelector('.wf-projects-vslider__viewport');
            var items = root.querySelectorAll('.wf-projects-vslider__item');
            var btnPrev = root.querySelector('[data-projects-prev]');
            var btnNext = root.querySelector('[data-projects-next]');
            var idxEl = root.querySelector('[data-projects-index]');
            var totalEl = root.querySelector('[data-projects-total]');

            if (!viewport || !items.length || !btnPrev || !btnNext) return;

            var index = 0;
            var max = items.length - 1;
            if (totalEl) totalEl.textContent = String(items.length);

            function clamp(n) {
                return Math.max(0, Math.min(max, n));
            }

            function scrollToIndex(nextIndex) {
                index = clamp(nextIndex);
                var top = items[index].offsetTop;
                viewport.scrollTo({ top: top, behavior: 'smooth' });
                render();
            }

            function syncFromScroll() {
                var probe = viewport.scrollTop + viewport.clientHeight * 0.5;
                var next = 0;
                for (var i = 0; i < items.length; i++) {
                    if (items[i].offsetTop <= probe) next = i;
                }
                index = clamp(next);
                render();
            }

            function render() {
                if (idxEl) idxEl.textContent = String(index + 1);
                btnPrev.disabled = index <= 0;
                btnNext.disabled = index >= max;
            }

            btnPrev.addEventListener('click', function () {
                scrollToIndex(index - 1);
            });

            btnNext.addEventListener('click', function () {
                scrollToIndex(index + 1);
            });

            // Keep index in sync when user scrolls/swipes.
            var ticking = false;
            viewport.addEventListener('scroll', function () {
                if (ticking) return;
                ticking = true;
                window.requestAnimationFrame(function () {
                    ticking = false;
                    syncFromScroll();
                });
            });

            // Keyboard support when focused.
            viewport.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowUp') {
                    scrollToIndex(index - 1);
                    e.preventDefault();
                }
                if (e.key === 'ArrowDown') {
                    scrollToIndex(index + 1);
                    e.preventDefault();
                }
            });

            // Initial state
            render();

            // Per-project image carousels
            var carousels = root.querySelectorAll('[data-project-carousel]');
            for (var c = 0; c < carousels.length; c++) {
                (function (carouselRoot) {
                    var cViewport = carouselRoot.querySelector('.wf-project-carousel__viewport');
                    var cItems = carouselRoot.querySelectorAll('.wf-project-carousel__item');
                    var cPrev = carouselRoot.querySelector('[data-carousel-prev]');
                    var cNext = carouselRoot.querySelector('[data-carousel-next]');

                    if (!cViewport || !cItems.length || !cPrev || !cNext) return;

                    var cIndex = 0;
                    var cMax = cItems.length - 1;

                    function cClamp(n) {
                        return Math.max(0, Math.min(cMax, n));
                    }

                    function cRender() {
                        cPrev.disabled = cIndex <= 0;
                        cNext.disabled = cIndex >= cMax;
                    }

                    function cScrollToIndex(nextIndex) {
                        cIndex = cClamp(nextIndex);
                        var left = cItems[cIndex].offsetLeft;
                        cViewport.scrollTo({ left: left, behavior: 'smooth' });
                        cRender();
                    }

                    function cSyncFromScroll() {
                        var probe = cViewport.scrollLeft + cViewport.clientWidth * 0.5;
                        var next = 0;
                        for (var i = 0; i < cItems.length; i++) {
                            if (cItems[i].offsetLeft <= probe) next = i;
                        }
                        cIndex = cClamp(next);
                        cRender();
                    }

                    cPrev.addEventListener('click', function () {
                        cScrollToIndex(cIndex - 1);
                    });

                    cNext.addEventListener('click', function () {
                        cScrollToIndex(cIndex + 1);
                    });

                    var cTicking = false;
                    cViewport.addEventListener('scroll', function () {
                        if (cTicking) return;
                        cTicking = true;
                        window.requestAnimationFrame(function () {
                            cTicking = false;
                            cSyncFromScroll();
                        });
                    });

                    cViewport.addEventListener('keydown', function (e) {
                        if (e.key === 'ArrowLeft') {
                            cScrollToIndex(cIndex - 1);
                            e.preventDefault();
                        }
                        if (e.key === 'ArrowRight') {
                            cScrollToIndex(cIndex + 1);
                            e.preventDefault();
                        }
                    });

                    cRender();
                })(carousels[c]);
            }
        })();
    </script>

    <script>
        (function () {
            var preloader = document.getElementById('wf-preloader');
            if (!preloader) return;

            var durationMs = 5000;
            var startedAt = Date.now();

            function hide() {
                preloader.classList.add('is-hidden');
                window.setTimeout(function () {
                    if (preloader && preloader.parentNode) preloader.parentNode.removeChild(preloader);
                }, 520);
            }

            function hideAfterMinDuration() {
                var elapsed = Date.now() - startedAt;
                var remaining = Math.max(0, durationMs - elapsed);
                window.setTimeout(hide, remaining);
            }

            hideAfterMinDuration();
        })();
    </script>
</body>

</html>
