import { useDispatch, useSelector } from "react-redux";
import { decrement, increment } from "../redux/counter/action";


function HooksCounter() {
    const count = useSelector((state) => state.value); // useSelector is a hook
    const dispatch = useDispatch();
    
    const incrementHandler = (value) => {
        dispatch(increment(value));
    }
    
    const decrementHandler = (value) => {
        dispatch(decrement(value));
    }
    return (
        <div class="p-4 h-auto flex flex-col items-center justify-center space-y-5 bg-white rounded shadow">
            <div className="text-2xl font-semibold">{count}</div>
            <div class="flex space-x-3">
                <button className="bg-indigo-400 text-white px-3 py-2 rounded shadow" onClick={() => incrementHandler(5.3)}>Increment</button>
                <button className="bg-indigo-400 text-white px-3 py-2 rounded shadow" onClick={() => decrementHandler(3.5)}>Decrement</button>
            </div>
        </div>
    );
}



export default HooksCounter;