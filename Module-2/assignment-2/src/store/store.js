import { applyMiddleware, combineReducers, createStore } from 'redux';
import { composeWithDevTools } from "redux-devtools-extension";
import logger from "redux-logger";
import { cartReducer } from './reducers/cartReducer';
import { productReducer } from './reducers/productReducer';
import { selectedReducer } from './reducers/selectedCartReducer';
const rootReducer = combineReducers({
  products: productReducer,
  carts: cartReducer,
  selectedProduct: selectedReducer,
})

const store = createStore(rootReducer, composeWithDevTools(applyMiddleware(logger)));
export default store;
