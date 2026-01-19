 {{-- Projects Grid --}}
 <div x-data="projectViewComponent">
     <div class="projects__grid">
         @foreach ($projectsData as $project)
             <div
                 class="projects__card"
                @click="openProject(@js($project))"
             >
                 <img
                     src="{{ $project['image_cover'] }}"
                     class="projects__image"
                 />

                 <div class="projects__content">
                     <h3 class="projects__title">{{ $project['title'] }}</h3>
                     <p class="projects__desc">{{ $project['delivered_at'] }}</p>
                     <p class="projects__desc">{{ $project['address'] }}</p>
                 </div>
             </div>
         @endforeach
     </div>

     {{-- Load More Button --}}
     @if (!$showViewAllProjectsBtn)
         <div class="projects__load-more">
             <x-button.outline
                 label="Load more"
                 wire:click="loadMore"
                 wire:target="loadMore"
                 wire:loading.class="spinner"
                 :disabled="!$hasMoreProjects"
             />
         </div>
     @endif

     {{-- View All Projects Button --}}
     @if ($showViewAllProjectsBtn)
         <div class="projects__load-more">
             <x-button.link
                 class="outline-btn"
                 label="View all projects"
                 :path="route('projects')"
             />
         </div>
     @endif
 </div>
