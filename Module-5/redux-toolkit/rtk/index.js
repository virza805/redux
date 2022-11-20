const store = require("./app/store");
const { counterActions } = require("./features/counter/counterSlice");
const { dynamicCounterActions } = require("./features/dynamicCounter/dynamicCounterSlice");
const { fetchPosts } = require("./features/post/postSlice");

// initial state
// console.log(store.getState()); // redux-logger pakeg টা করে দিবে

// subscribe to state changes
store.subscribe(() => {
    // console.log(store.getState()); // redux-logger pakeg টা করে দিবে
});

// disptach actions
// store.dispatch(counterActions.increment());
// store.dispatch(counterActions.increment());
// store.dispatch(counterActions.decrement());

// disptach actions
// store.dispatch(dynamicCounterActions.increment(3));
// store.dispatch(dynamicCounterActions.increment(4));
// store.dispatch(dynamicCounterActions.decrement(2));

// disptach actions
store.dispatch(fetchPosts());