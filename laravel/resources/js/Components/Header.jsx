import '@styles/header.css';

export default function Header() {
    return (
        <header className="header-title flex h-20 w-full bg-violet-700 items-center justify-center shadow-md">
            <img src="/images/logo.png" alt="Logo" className="absolute left-5 h-16" />
            <h1 className="text-6xl text-white">FlashMind</h1>
        </header>
    );
}