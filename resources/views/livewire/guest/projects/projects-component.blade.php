 {{-- Projects Grid --}}
 <div x-data="projectsComponent">
     <div class="projects__grid">
         @forelse ($projectsData as $project)
             <div
                 class="projects__card"
                 wire:target="viewProject('{{ $project['uuid'] }}')"
                 wire:loading.class="spinner"
                 @click="viewProject(`{{ $project['uuid'] }}`)"
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
         @empty
             <div class="empty">
                 No projects found
             </div>
         @endforelse
     </div>

     {{-- Load More Button --}}
     @if (!$isProjectSection)
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
     @if ($isProjectSection && !empty($projectsData))
         <div class="projects__load-more">
             <x-button.link
                 class="outline-btn"
                 label="View all projects"
                 :path="route('projects')"
             />
         </div>
     @endif
 </div>
