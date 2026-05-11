<div
    x-data="siteEditorComponent"
    class="site-editor"
>

    {{-- Header --}}
    <header class="content-header row">
        <span>Site Editor</span>

        <x-button.link
            class="outlined-btn"
            label="Full Preview"
            :href="route('landing')"
        />
    </header>

    <div class="site-editor-content">
        {{-- Editor Inputs --}}
        <div
            class="site-editor-inputs"
            x-ref="sectionsContainer"
            wire:ignore
        >

            @foreach ($sections as $key => $section)
                <div
                    class="section-block"
                    :data-key="'{{ $key }}'"
                >

                    <x-label.info
                        :label="ucfirst($key)"
                        description="Update section content"
                    />

                    {{-- HERO DATA --}}
                    @if ($key === 'hero')
                        <div class="extra-data">
                            <x-form.input
                                label="Light Text"
                                x-model="sections['{{ $key }}'].data.title.light"
                            />

                            <x-form.input
                                label="Main Text"
                                x-model="sections['{{ $key }}'].data.title.main"
                            />

                            <x-form.input
                                label="Accent Text"
                                x-model="sections['{{ $key }}'].data.title.accent"
                            />
                        </div>
                    @endif

                    @if (!in_array($key, ['hero', 'footer']))
                        {{-- Generic Fields --}}
                        <x-form.textarea
                            label="Title"
                            placeholder="Title"
                            x-model="sections['{{ $key }}'].title"
                        />
                    @endif


                    {{-- About Description --}}
                    @if ($key === 'about')
                        <x-form.textarea
                            label="Description"
                            placeholder="Description"
                            x-model="sections['{{ $key }}'].description"
                        />
                    @endif


                    {{-- FOOTER SOCIALS --}}
                    @if ($key === 'footer')
                        <template
                            x-for="(social, index) in sections['footer'].data.socials"
                            :key="index"
                        >
                            <div class="extra-data">
                                <x-form.select
                                    label="Icon"
                                    :options="[
                                        ['label' => 'Email', 'value' => 'fi-tr-envelope'],
                                        ['label' => 'Phone', 'value' => 'fi-tr-phone-call'],
                                        ['label' => 'Facebook', 'value' => 'fi-brands-facebook'],
                                        ['label' => 'Instagram', 'value' => 'fi-brands-instagram'],
                                        ['label' => 'LinkedIn', 'value' => 'fi-brands-linkedin'],
                                        ['label' => 'X', 'value' => 'fi-brands-twitter-alt-circle'],
                                    ]"
                                    x-model="social.icon"
                                />

                                <x-form.input
                                    label="Link"
                                    x-model="social.link"
                                />

                                <x-button.outlined
                                    class="danger !w-full"
                                    label="Delete"
                                    @click="deleteLink('footer', index)"
                                />
                            </div>
                        </template>

                        <x-button.outlined
                            class="!w-full"
                            label="Add Social"
                            @click="addLink('footer')"
                        />
                    @endif

                    {{-- Visibility --}}
                    <x-label.info label="Visible">
                        <x-form.checkbox x-model="sections['{{ $key }}'].visible" />
                    </x-label.info>

                </div>
            @endforeach

            {{-- Actions --}}
            <div class="site-editor-actions">
                <x-button.primary
                    label="Update"
                    @click="submit"
                    wire:loading.class="spinner"
                />
            </div>
        </div>

        {{-- Preview --}}
        <div
            class="site-editor-preview spinner"
            x-ref="iframeContainer"
            wire:ignore
        >
            <iframe
                x-ref="iframPreview"
                src="{{ route('admin.settings.site-preview') }}"
            ></iframe>
        </div>
    </div>
</div>
