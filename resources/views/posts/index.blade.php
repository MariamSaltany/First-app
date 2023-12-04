<x-Layout >
  @include('posts._header')

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6"> 
            @if ($posts->count())
               <x-posts-grid :posts="$posts" class=" $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"/>
               {{ $posts->links() }}
        @else
              <p class ="text-center"> No posts yet. Please check back </p>
            @endif
         </main>
</x-Layout>