
    <div class="fixed flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[70%] rounded-t-lg ml-64">
        <div class="relative md:w-[320px] xl:w-[300px] overflow-y-auto shrink-0 border">

            <livewire:chat.chat-list :selectedConversation="$selectedConversation" :query="$query">

        </div>
        <div class="md:grid w-full border-l h-full relative overflow-y-auto">

            <livewire:chat.chat-box :selectedConversation="$selectedConversation" >
                
        </div>
    </div>

