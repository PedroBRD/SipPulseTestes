<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SipPulseTestes')</title>
    <style>
        :root {
            color-scheme: light;
            --blue: #0056b3;
            --navy: #0A2540;
            --pale-blue: #e6f0fa;
            --surface: #ffffff;
            --ink: #243447;
            --muted: #62748a;
            --border: #d4e0ec;
            --shadow: 0 12px 32px rgba(10, 37, 64, .09);
        }

        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            background: var(--pale-blue);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }
        h1, h2, h3, th {
            color: var(--navy);
            font-family: 'Serif Bold', Georgia, 'Times New Roman', serif;
            font-weight: 700;
        }
        a { color: var(--blue); }
        button, input, select, textarea { font: inherit; }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 68px;
            padding: .8rem clamp(1rem, 5vw, 4rem);
            background: var(--navy);
            color: #fff;
        }
        .brand { color: #fff; font-size: 1.1rem; font-weight: 700; text-decoration: none; }
        .topbar form { margin: 0; }
        .topbar .button { border-color: rgba(255,255,255,.45); background: transparent; color: #fff; }
        .page { width: min(1080px, calc(100% - 2rem)); margin: 2.5rem auto; }
        .page-heading { margin: 0 0 1.25rem; font-size: clamp(1.6rem, 4vw, 2.1rem); }
        .panel, .login-card {
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface);
            box-shadow: var(--shadow);
        }
        .panel { padding: clamp(1rem, 3vw, 1.75rem); }
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: .6rem 1rem;
            border: 1px solid var(--blue);
            border-radius: 6px;
            background: var(--blue);
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }
        .button:hover { background: var(--navy); border-color: var(--navy); }
        .button-secondary { background: #fff; color: var(--blue); }
        .login-shell { display: grid; min-height: 100vh; place-items: center; padding: 1.25rem; }
        .login-card { width: min(100%, 430px); padding: clamp(1.5rem, 5vw, 2.25rem); }
        .login-card h1 { margin: 0 0 1.5rem; text-align: center; font-size: 1.8rem; }
        .form-field { display: grid; gap: .4rem; margin-bottom: 1rem; }
        .form-field label { color: var(--navy); font-weight: 700; }
        .form-field input, .form-field select, .form-field textarea,
        .panel form > input:not([type="hidden"]):not([type="checkbox"]),
        .panel form > select, .panel form > textarea {
            width: 100%;
            min-height: 44px;
            padding: .65rem .75rem;
            border: 1px solid #b9cce0;
            border-radius: 6px;
            background: #fff;
            color: var(--ink);
        }
        .form-field input:focus, .form-field select:focus, .form-field textarea:focus,
        .panel form > input:focus, .panel form > select:focus,
        .panel form > textarea:focus { outline: 3px solid rgba(0, 86, 179, .15); border-color: var(--blue); }
        .panel form > label { display: block; margin: .85rem 0 .3rem; color: var(--navy); font-weight: 700; }
        .panel form > input[type="checkbox"] { width: 1rem; height: 1rem; margin: .35rem 0 0 .35rem; accent-color: var(--blue); }
        .panel form > button { margin-top: 1rem; }
        .login-card .button { width: 100%; margin-top: .35rem; }
        .alert { margin-bottom: 1rem; padding: .75rem 1rem; border-radius: 6px; background: #fff0f0; color: #8c2424; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem; }
        .dashboard-card {
            display: flex;
            min-height: 190px;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            color: var(--ink);
            text-decoration: none;
            box-shadow: var(--shadow);
            transition: background-color .18s ease, border-color .18s ease, transform .18s ease;
        }
        .dashboard-card:hover { transform: translateY(-3px); border-color: #9dbfe0; background: var(--pale-blue); }
        .dashboard-card h2 { margin: 0 0 .5rem; font-size: 1.35rem; }
        .dashboard-card p { margin: 0; color: var(--muted); }
        .card-link { margin-top: 1.25rem; color: var(--blue); font-weight: 700; }
        .action-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
        .action-card { padding: 1.15rem; border: 1px solid var(--border); border-radius: 8px; background: #fff; }
        .action-card h2, .action-card h3 { margin: 0 0 .7rem; font-size: 1.15rem; }
        .action-card .button { margin-top: .25rem; }
        .form-note { margin: 0 0 1rem; color: var(--muted); }
        .detail-list { display: grid; grid-template-columns: minmax(130px, .35fr) 1fr; margin: 0; }
        .detail-list dt, .detail-list dd { margin: 0; padding: .8rem; border-bottom: 1px solid var(--border); }
        .detail-list dt { color: var(--navy); font-weight: 700; }
        .detail-list dd:last-child, .detail-list dt:nth-last-of-type(1) { border-bottom: 0; }
        .table-wrap { overflow-x: auto; border: 1px solid var(--border); border-radius: 8px; background: #fff; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: .85rem 1rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        thead th { background: var(--navy); color: #fff; white-space: nowrap; }
        thead th { font-family: Arial, Helvetica, sans-serif; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #f5f9fd; }
        .table-actions { display: flex; align-items: center; flex-wrap: wrap; gap: .65rem; }
        .table-actions form { margin: 0; }
        .text-link { font-weight: 700; text-decoration: none; }
        .section-title { margin: 1.75rem 0 .75rem; font-size: 1.25rem; }
        .section-title:first-of-type { margin-top: 0; }
        .back-link { display: inline-block; margin-top: 1.25rem; font-weight: 700; text-decoration: none; }

        @media (max-width: 640px) {
            .page { margin: 1.25rem auto; }
            .dashboard-grid { grid-template-columns: 1fr; }
            .action-list { grid-template-columns: 1fr; }
            .dashboard-card { min-height: 150px; }
            th, td { padding: .7rem; }
            .table-actions { align-items: flex-start; flex-direction: column; }
            .topbar { min-height: 60px; }
            .detail-list { grid-template-columns: 1fr; }
            .detail-list dt { padding-bottom: .15rem; border-bottom: 0; }
            .detail-list dd { padding-top: .15rem; }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
