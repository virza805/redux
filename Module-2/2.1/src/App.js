import { Provider } from "react-redux";
import DynamicHooksCounter from "./components/DynamicHooksCounter";
import HooksCounter from "./components/HooksCounter";
import VariableCounter from "./components/VariableCounter";
import store from "./redux/store";


export default function App() {

    
    return ( 
    <Provider store={store}>
        <div class="w-screen h-screen p-10 bg-gray-100 text-slate-700">
            
            <h1 class="max-w-md mx-auto text-center text-2xl font-bold text-green-600">
                Simple Counter Application
            </h1>


            <div class="max-w-md mx-auto mt-10 space-y-5 bg-green-200">
                
            <HooksCounter />
            <DynamicHooksCounter />
                {/* <Stats count={totalCount()} /> */}
                <VariableCounter />
                <VariableCounter dynamic />
            </div>
        </div>
    </Provider>
    );
}