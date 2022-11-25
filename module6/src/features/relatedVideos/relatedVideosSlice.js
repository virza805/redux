import { getRelatedVideos } from "./relatedVideosAPI";

const {createSlice, createAsyncThunk} = require("@reduxjs/toolkit");

// initial State
const initialState = {
    relatedVideos: [],
    isLoading: false,
    isError: false,
    error: "",
}
// Async thunk
export const fetchRelatedVideos = createAsyncThunk('relatedVideos/fetchRelatedVideos', async ({tags,id}) => {
    const relatedVideos = await getRelatedVideos({tags, id});
    return relatedVideos;
});

// Slice
const relatedVideosSlice = createSlice({
    name: "relatedVideos",
    initialState,
    extraReducers: (builder) => {
        builder
        .addCase(fetchRelatedVideos.pending, (state) => {
            state.isError = false;
            state.isLoading = true;
        })
        .addCase(fetchRelatedVideos.fulfilled, (state, action) => {
            state.isLoading = false;
            state.relatedVideos = action.payload;
        })
        .addCase(fetchRelatedVideos.rejected, (state, action) => {
            state.isLoading = false;
            state.relatedVideos = [];
            state.isError = true;
            state.error = action.error?.message;
        })
        
    }
});

export default relatedVideosSlice.reducer;