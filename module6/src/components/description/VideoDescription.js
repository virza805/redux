import LikeUnlike from "./LikeUnlike";

export default function VideoDescription({video}) {
    const {title, date, description, unlikes, likes, views} = video;
    return (
        <div>
            <h1 class="text-lg font-semibold tracking-tight text-slate-800">
                {title}
            </h1>
            <div class="pb-4 flex items-center space-between border-b">
                <h2 class="text-sm leading-[1.7142857] text-slate-600 w-full">
                  Total views {views} | Uploaded on {date}
                </h2>

                <LikeUnlike likes={likes} unlikes={unlikes} />
            </div>

            <div class="mt-4 text-sm text-[#334155] dark:text-slate-400">
                {description}
            </div>
        </div>
    );
}
