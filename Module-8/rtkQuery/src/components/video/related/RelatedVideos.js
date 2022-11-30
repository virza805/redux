import { useGetRelatedVideosQuery } from "../../../features/api/apiSlice";
import Error from "../../ui/Error";
import RelatedVideoLoader from "../../ui/loaders/RelatedVideoLoader";
import RelatedVideo from "./RelatedVideo";

export default function RelatedVideos({videoId, title}) {

    const {data: relatedVideos, isLoading, isError} = useGetRelatedVideosQuery({videoId, title});

    // deside whate to render
    let content = null;
    if(isLoading){
        content = (<>
        <RelatedVideoLoader />
        <RelatedVideoLoader />
        <RelatedVideoLoader />
        </>);
    }
    if(!isLoading && isError){
        content = <Error message = "Some thing is wrang for show error! "/>;
    }
    if(!isLoading && !isError && relatedVideos?.length === 0){
        content = <Error message = "No related videos found!"/>;
    }
    if(!isLoading && !isError && relatedVideos?.length > 0){
        content = relatedVideos.map((video) => <RelatedVideo key={video.id} video={video} />);
        // content = <RelatedVideo key={videoId} title={title} />;
    }

    return (
        <div className="col-span-full lg:col-auto max-h-[570px] overflow-y-auto">
            {content}
        </div>
    );
}
