<?php
/**
 * FreeStudy content catalogue.
 * Every resource here is either an official public source or an NCERT PDF.
 * Replace/add providers here without changing the UI.
 */
return [
    'app' => [
        'name' => 'OpenStudy',
        'tagline' => 'A calm place to learn, practise and keep moving.',
        'notice' => 'Free resources only · Official public lectures + NCERT study material',
    ],
    'batches' => [
        [
            'id' => 'jee-core',
            'title' => 'JEE Core — Free Foundation',
            'subtitle' => 'Physics, Chemistry and Mathematics from the basics',
            'level' => 'JEE / Class 11–12',
            'accent' => 'violet',
            'icon' => '✦',
            'subjects' => [
                [
                    'id' => 'jee-physics', 'name' => 'Physics', 'short' => 'PH', 'color' => 'blue',
                    'chapters' => [
                        [
                            'id' => 'units-measurement', 'name' => 'Units and Measurement', 'duration' => '6 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+units+and+measurements+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/keph101.pdf',
                            'notes_title' => 'NCERT Physics Part I · Chapter 1',
                            'dpp' => [
                                ['q' => 'The dimensional formula of force is:', 'options' => ['MLT⁻¹', 'ML²T⁻²', 'MLT⁻²', 'M⁰LT⁻²'], 'answer' => 2, 'why' => 'Force = mass × acceleration = M × LT⁻².'],
                                ['q' => 'How many significant figures are in 0.00450?', 'options' => ['2', '3', '4', '5'], 'answer' => 1, 'why' => 'Leading zeroes do not count; 4, 5 and the trailing zero count.'],
                            ],
                        ],
                        [
                            'id' => 'motion-straight-line', 'name' => 'Motion in a Straight Line', 'duration' => '8 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+motion+in+a+straight+line+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/keph102.pdf',
                            'notes_title' => 'NCERT Physics Part I · Chapter 2',
                            'dpp' => [
                                ['q' => 'The slope of a displacement–time graph gives:', 'options' => ['Acceleration', 'Velocity', 'Distance', 'Jerk'], 'answer' => 1, 'why' => 'The slope is change in displacement per unit time, which is velocity.'],
                                ['q' => 'For uniform motion, acceleration is:', 'options' => ['Constant and non-zero', 'Variable', 'Zero', 'Infinite'], 'answer' => 2, 'why' => 'Uniform motion has constant velocity, so acceleration is zero.'],
                            ],
                        ],
                        [
                            'id' => 'laws-of-motion', 'name' => 'Laws of Motion', 'duration' => '9 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+Newton+laws+of+motion+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/keph104.pdf',
                            'notes_title' => 'NCERT Physics Part I · Chapter 4',
                            'dpp' => [
                                ['q' => 'Newton’s second law connects force with:', 'options' => ['Momentum change per time', 'Displacement only', 'Mass only', 'Potential energy'], 'answer' => 0, 'why' => 'F = dp/dt; for constant mass, F = ma.'],
                                ['q' => 'Action and reaction forces act on:', 'options' => ['The same body', 'Different bodies', 'Only a moving body', 'No body'], 'answer' => 1, 'why' => 'The pair is equal and opposite but acts on two different bodies.'],
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 'jee-chemistry', 'name' => 'Chemistry', 'short' => 'CH', 'color' => 'orange',
                    'chapters' => [
                        [
                            'id' => 'some-basic-concepts', 'name' => 'Some Basic Concepts of Chemistry', 'duration' => '7 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+some+basic+concepts+of+chemistry+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kebo101.pdf',
                            'notes_title' => 'NCERT Chemistry Part I · Chapter 1',
                            'dpp' => [
                                ['q' => 'One mole contains approximately:', 'options' => ['6.022 × 10²³ particles', '9.8 particles', '3.14 × 10⁸ particles', '1.66 × 10⁻²⁷ particles'], 'answer' => 0, 'why' => 'Avogadro’s number is 6.022 × 10²³ particles per mole.'],
                                ['q' => 'Molar mass of H₂O is:', 'options' => ['16 g mol⁻¹', '18 g mol⁻¹', '20 g mol⁻¹', '22 g mol⁻¹'], 'answer' => 1, 'why' => '2 × 1 + 16 = 18 g mol⁻¹.'],
                            ],
                        ],
                        [
                            'id' => 'structure-atom', 'name' => 'Structure of Atom', 'duration' => '8 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+structure+of+atom+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kebo102.pdf',
                            'notes_title' => 'NCERT Chemistry Part I · Chapter 2',
                            'dpp' => [
                                ['q' => 'The maximum number of electrons in a shell with n = 2 is:', 'options' => ['2', '4', '8', '18'], 'answer' => 2, 'why' => 'Maximum electrons = 2n² = 2 × 2² = 8.'],
                                ['q' => 'The charge of an electron is:', 'options' => ['Positive', 'Negative', 'Neutral', 'Variable'], 'answer' => 1, 'why' => 'An electron carries one unit of negative charge.'],
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 'jee-maths', 'name' => 'Mathematics', 'short' => 'MA', 'color' => 'pink',
                    'chapters' => [
                        [
                            'id' => 'sets', 'name' => 'Sets', 'duration' => '6 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+sets+class+11+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kemh101.pdf',
                            'notes_title' => 'NCERT Mathematics Part I · Chapter 1',
                            'dpp' => [
                                ['q' => 'If A has 3 elements, the number of subsets of A is:', 'options' => ['3', '6', '8', '9'], 'answer' => 2, 'why' => 'A set with n elements has 2ⁿ subsets.'],
                                ['q' => 'The empty set is a subset of:', 'options' => ['Only itself', 'Every set', 'No set', 'Only finite sets'], 'answer' => 1, 'why' => 'The empty set is a subset of every set.'],
                            ],
                        ],
                        [
                            'id' => 'relations-functions', 'name' => 'Relations and Functions', 'duration' => '8 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+relations+and+functions+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kemh102.pdf',
                            'notes_title' => 'NCERT Mathematics Part I · Chapter 2',
                            'dpp' => [
                                ['q' => 'A function maps each element of its domain to:', 'options' => ['Exactly one range element', 'At least two elements', 'No element', 'Only itself'], 'answer' => 0, 'why' => 'That uniqueness condition defines a function.'],
                                ['q' => 'The domain is the set of:', 'options' => ['Output values', 'Input values', 'Unused values', 'Constants only'], 'answer' => 1, 'why' => 'Inputs belong to the domain; outputs belong to the range.'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'id' => 'neet-biology',
            'title' => 'NEET Biology — NCERT First',
            'subtitle' => 'A chapter-by-chapter biology revision path',
            'level' => 'NEET / Class 11–12',
            'accent' => 'emerald',
            'icon' => '◉',
            'subjects' => [
                [
                    'id' => 'neet-botany', 'name' => 'Botany', 'short' => 'BT', 'color' => 'green',
                    'chapters' => [
                        [
                            'id' => 'living-world', 'name' => 'The Living World', 'duration' => '5 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+NEET+the+living+world+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kebo101.pdf',
                            'notes_title' => 'NCERT Biology · Chapter 1',
                            'dpp' => [
                                ['q' => 'The basic unit of classification is:', 'options' => ['Kingdom', 'Phylum', 'Species', 'Family'], 'answer' => 2, 'why' => 'Species is the basic unit of biological classification.'],
                                ['q' => 'Binomial nomenclature was popularised by:', 'options' => ['Darwin', 'Linnaeus', 'Mendel', 'Watson'], 'answer' => 1, 'why' => 'Carolus Linnaeus formalised the two-name system.'],
                            ],
                        ],
                        [
                            'id' => 'biological-classification', 'name' => 'Biological Classification', 'duration' => '7 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+NEET+biological+classification+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kebo102.pdf',
                            'notes_title' => 'NCERT Biology · Chapter 2',
                            'dpp' => [
                                ['q' => 'The five-kingdom classification was proposed by:', 'options' => ['Whittaker', 'Linnaeus', 'Aristotle', 'Haeckel'], 'answer' => 0, 'why' => 'R. H. Whittaker proposed the five-kingdom system.'],
                                ['q' => 'Prokaryotic organisms lack a:', 'options' => ['Cell membrane', 'Ribosome', 'Membrane-bound nucleus', 'Cytoplasm'], 'answer' => 2, 'why' => 'Their genetic material is not enclosed in a membrane-bound nucleus.'],
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 'neet-zoology', 'name' => 'Zoology', 'short' => 'ZO', 'color' => 'teal',
                    'chapters' => [
                        [
                            'id' => 'animal-kingdom', 'name' => 'Animal Kingdom', 'duration' => '9 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+NEET+animal+kingdom+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kebo104.pdf',
                            'notes_title' => 'NCERT Biology · Animal Kingdom',
                            'dpp' => [
                                ['q' => 'Animals with a notochord belong to:', 'options' => ['Chordata', 'Porifera', 'Annelida', 'Mollusca'], 'answer' => 0, 'why' => 'The defining feature of chordates is the notochord at some stage.'],
                                ['q' => 'Radial symmetry is characteristic of:', 'options' => ['Earthworms', 'Jellyfish', 'Cockroaches', 'Humans'], 'answer' => 1, 'why' => 'Cnidarians such as jellyfish show radial symmetry.'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'id' => 'ncert-revision',
            'title' => 'NCERT Revision Room',
            'subtitle' => 'Short daily sessions for school and entrance prep',
            'level' => 'All learners',
            'accent' => 'amber',
            'icon' => '✺',
            'subjects' => [
                [
                    'id' => 'revision-physics', 'name' => 'Physics Revision', 'short' => 'PR', 'color' => 'indigo',
                    'chapters' => [
                        [
                            'id' => 'work-energy-power', 'name' => 'Work, Energy and Power', 'duration' => '8 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+work+energy+power+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/keph106.pdf',
                            'notes_title' => 'NCERT Physics Part I · Chapter 6',
                            'dpp' => [
                                ['q' => 'Work done by a force perpendicular to displacement is:', 'options' => ['Maximum', 'Zero', 'Negative always', 'Infinite'], 'answer' => 1, 'why' => 'W = Fs cos θ; cos 90° = 0.'],
                                ['q' => 'The SI unit of power is:', 'options' => ['Joule', 'Newton', 'Watt', 'Pascal'], 'answer' => 2, 'why' => 'Power is the rate of doing work and is measured in watts.'],
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 'revision-maths', 'name' => 'Mathematics Revision', 'short' => 'MR', 'color' => 'rose',
                    'chapters' => [
                        [
                            'id' => 'trigonometric-functions', 'name' => 'Trigonometric Functions', 'duration' => '8 lessons',
                            'lecture' => 'https://www.youtube.com/results?search_query=Physics+Wallah+trigonometric+functions+free+lecture',
                            'lecture_title' => 'Find the official free lecture',
                            'notes' => 'https://ncert.nic.in/textbook/pdf/kemh103.pdf',
                            'notes_title' => 'NCERT Mathematics Part I · Chapter 3',
                            'dpp' => [
                                ['q' => 'The value of sin²θ + cos²θ is:', 'options' => ['0', '1', '2', 'Depends on θ'], 'answer' => 1, 'why' => 'This is the fundamental Pythagorean identity.'],
                                ['q' => 'The period of sin x is:', 'options' => ['π/2', 'π', '2π', '4π'], 'answer' => 2, 'why' => 'sin(x + 2π) = sin x.'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
