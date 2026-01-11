<div
    x-data="siteEditorComponent"
    class="site-editor"
>

    {{-- Content Header --}}
    <header class="content-header row">
        <span>Site Editor</span>

        <x-button.link
            class="outline-btn"
            label="Full Preview"
            :path="route('landing')"
        />
    </header>

    <div class="site-editor-content">
        {{-- Editor Inputs --}}
        <div
            class="site-editor-inputs"
            x-ref="sectionsContainer"
            wire:ignore
        >

            @foreach ($landingSectionsData as $key => $section)
                <div
                    class="section-block"
                    :data-key="'{{ $key }}'"
                >

                    {{-- Section Label --}}
                    <x-label.info
                        :label="ucfirst($key)"
                        description="Update the main description text shown at the top of your landing page."
                    />

                    {{-- Title --}}
                    <x-form.textarea
                        placeholder="Title"
                        x-model="sections['{{ $key }}'].title"
                    ></x-form.textarea>

                    {{-- Description --}}
                    <x-form.textarea
                        placeholder="Description"
                        x-model="sections['{{ $key }}'].description"
                    ></x-form.textarea>

                    {{-- Footer Properties --}}
                    @if ($key === 'footer')
                        <template
                            x-for="(social, index) in sections['{{ $key }}'].data.socials"
                            :key="index"
                        >
                            <div class="extra-data">

                                <x-form.select
                                    label="Icon"
                                    placeholder="Select Icon"
                                    :options="[
                                        ['label' => 'Facebook', 'value' => 'fi-brands-facebook'],
                                        ['label' => 'Instagram', 'value' => 'fi-brands-instagram'],
                                        ['label' => 'LinkedIn', 'value' => 'fi-brands-linkedin'],
                                        ['label' => 'X', 'value' => 'fi-brands-twitter-alt-circle'],
                                    ]"
                                    x-model="social.icon"
                                />

                                <x-form.input
                                    label="Link"
                                    placeholder="https://example.com"
                                    x-model="social.link"
                                />

                                <x-button.outline
                                    class="danger !w-full"
                                    label="Delete Link"
                                    @click="deleteLink('{{ $key }}', index)"
                                />
                            </div>
                        </template>

                        <x-button.outline
                            class="!w-full"
                            label="Add Social Link"
                            @click="addLink('{{ $key }}')"
                        />
                    @endif

                    {{-- Visibility --}}
                    <x-label.info label="Visible">
                        <x-form.toggle x-model="sections['{{ $key }}'].visible" />
                    </x-label.info>
                </div>
            @endforeach

            @if (!empty($landingSectionsData))
                {{-- Actions --}}
                <div class="site-editor-actions">
                    <x-button.main
                        label="Update"
                        @click="submit"
                        wire:loading.class="spinner"
                        wire:target="submit"
                    />
                    <x-button.outline
                        label="Preview"
                        @click="updatePreview"
                    />
                </div>
            @endif
        </div>

        {{-- Preview Iframe --}}
        <div
            class="site-editor-preview spinner"
            x-ref="iframeContainer"
            wire:ignore
        >
            <iframe
                id="preview"
                x-ref="iframPreview"
                src="{{ route('admin.settings.site-preview') }}"
            ></iframe>
        </div>
    </div>
</div>
