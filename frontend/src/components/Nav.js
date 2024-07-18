export default function Nav(props) {
    const { visible } = props;
    return (
        <div className="flex relative">
            <ul className={`${visible ? "w-full sm:w-48" : "w-0"} transition-width duration-500 flex flex-col font-bold
             h-screen fixed pt-20 left-0 bg-half-transparent justify-center items-center`}>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    Início
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    Products
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    Categories
                </li>
                <li className={`${visible ? 'flex' : 'hidden'} text-white hover:text-salmon w-full sm:w-32 m-1 p-5 justify-center`}>
                    Sales
                </li>
            </ul>
        </div>
    );
}