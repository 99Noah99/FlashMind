import Header from "@components/Header";
import { useState } from 'react'
import { useForm } from '@inertiajs/react'


export default function Home() {

    const [csv_file, setCSV_file] = useState(null);

    const { data, setData, post, processing, errors } = useForm({
        value: '',
        type: '',
    });

    function handleSubmit(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        post('/generate', {
            preserveScroll: true,
            preserveUrl: true,
            onSuccess: (response) => {
                setCSV_file(response.props.response_csv_file);
                console.log(response.props.response_csv_file);
            }
        });
    }

    return (
        <>
            <Header />
            <div>
                <section className="flex flex-col items-center justify-center h-100 gap-20 px-10">
                    <div className="text-7xl text-center text-violet-700 font-bold">
                        Apprennez plus rapidement que l'éclair !
                    </div>
                    <div className="text-2xl text-center font-semibold">
                        Générez des flashcards à intégrer directement dans Anki grâce à l'IA
                    </div>
                </section>

                <section className="flex flex-col w-full justify-center items-center">

                    <div>Copier votre texte juste ici : </div>
                    <form onSubmit={handleSubmit} className="flex flex-col items-center justify-center w-full max-w-5xl">
                        <div className="flex justify-center items-center w-full px-10">
                            <textarea
                                className="bg-gray-100 border-2 border-dashed border-violet-700 rounded-lg p-3 w-full max-w-5xl h-auto focus:outline-none focus:shadow-[0px_5px_10px_rgba(112,8,231,0.30)] transition-all"
                                rows="5"
                                name="text_area"
                                value={data.value}
                                onChange={(e) => console.log(e) & setData('value', e.target.value)}
                                placeholder="Entrez votre texte ici..." />
                        </div>
                        <button type="submit" disabled={processing} className="bg-violet-700 text-white rounded-lg p-3 mt-4">
                            {processing ? 'En cours...' : 'Générer mes flashcards'}
                        </button>
                    </form>
                    {csv_file && <div className="text-green-500">{csv_file}</div>}
                </section>

                <section className="flex flex-row items-center justify-center mt-5">
                    <iframe src="https://lottie.host/embed/0542db4c-0237-4f8b-bf93-7a665b68ae4d/dErSlc4KIm.lottie"></iframe>
                </section>
            </div>
        </>
    );
}