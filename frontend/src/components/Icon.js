export default function Icon(props) {
    const { setVisible, visible } = props;
    return (
        <div
            className="flex flex-col fixed top-0 left-0 z-40 p-5"
            onClick={() => setVisible(!visible)}
        >
            <div className={`${visible ? "rotate-45 translate-y-2 bg-white" : "bg-black"} h-1 w-8 mb-1 transition duration-500`} />
            <div className={`${visible ? "rotate-_45 bg-white" : "bg-black"} h-1 w-8 mb-1 transition duration-500`} />
            <div className={`${visible ? "hidden" : "flex bg-black"} h-1 w-8 mb-1 transition duration-500`} />
        </div>
    );
}