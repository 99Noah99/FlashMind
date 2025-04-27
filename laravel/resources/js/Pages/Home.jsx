import React from 'react';

const Home = () => {
    return (
        <div className="home-page bg-gray-100 min-h-screen flex flex-col items-center justify-center">
            <header className="home-header text-center mb-8">
                <h1 className="text-4xl font-bold text-blue-600 mb-4">Welcome to FlashMind</h1>
                <p className="text-lg text-gray-700">Your platform for quick learning and knowledge sharing.</p>
            </header>
            <main className="home-content max-w-4xl mx-auto">
                <section className="mb-8 p-6 bg-white shadow-md rounded-lg">
                    <h2 className="text-2xl font-semibold text-gray-800 mb-2">About Us</h2>
                    <p className="text-gray-600">FlashMind is designed to help you learn and share knowledge efficiently.</p>
                </section>
                <section className="p-6 bg-white shadow-md rounded-lg">
                    <h2 className="text-2xl font-semibold text-gray-800 mb-2">Get Started</h2>
                    <p className="text-gray-600">Create an account or log in to explore our features.</p>
                </section>
            </main>
        </div>
    );
};

export default Home;