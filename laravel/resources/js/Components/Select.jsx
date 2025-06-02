export default function Select({ type, setType }) {
    return (
        <label className="text-xl mb-2"> Veuillez choisir à partir de quoi générer les FlashCards :

            <select
                value={type}
                onChange={(e) => setType(e.target.value)} name="type"
                required
                className="bg-gray-100 ml-4 border-1 border-violet-700 rounded-md focus:outline-none focus:shadow-[0px_5px_10px_rgba(112,8,231,0.30)] transition-all"
            >

                <option
                    value="texte"
                    className="bg-gray-100 border-2 border-dashed border-violet-700 rounded-lg p-3 w-full max-w-5xl h-auto focus:outline-none focus:shadow-[0px_5px_10px_rgba(112,8,231,0.30)] transition-all"
                >Texte</option>
                <option
                    value="pdf"
                    className="bg-gray-100 border-2 border-dashed border-violet-700 rounded-lg p-3 w-full max-w-5xl h-auto focus:outline-none focus:shadow-[0px_5px_10px_rgba(112,8,231,0.30)] transition-all"
                > Fichier PDF</option>

            </select>
        </label>
    )
}